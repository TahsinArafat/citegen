<?php
/*
Plugin Name: CiteGen
Description: Automatically generates APA and MLA citations for posts and pages with style selection and copy functionality. This plugin is supported by the Co-Authors Plus plugin for multiple authors.
Version: 2.0
Author URI: https://github.com/TahsinArafat
Author: Tahsin Arafat
*/

// Exit if accessed directly outside of WordPress
if (!defined('ABSPATH')) {
    exit;
}

// Register default settings
function citegen_register_settings()
{
    register_setting('citegen_settings', 'citegen_auto_show', [
        'type' => 'boolean',
        'default' => true,
        'sanitize_callback' => 'rest_sanitize_boolean'
    ]);
    register_setting('citegen_settings', 'citegen_ui_preset', [
        'type' => 'string',
        'default' => 'default',
        'sanitize_callback' => 'sanitize_text_field'
    ]);
}
add_action('admin_init', 'citegen_register_settings');

// Add admin menu
function citegen_add_admin_menu()
{
    add_options_page(
        'CiteGen Settings',
        'CiteGen',
        'manage_options',
        'citegen-settings',
        'citegen_settings_page'
    );
}
add_action('admin_menu', 'citegen_add_admin_menu');

// Settings page
function citegen_settings_page()
{
    if (!current_user_can('manage_options')) {
        return;
    }
    
    if (isset($_GET['settings-updated'])) {
        add_settings_error('citegen_messages', 'citegen_message', 'Settings Saved', 'updated');
    }
    
    settings_errors('citegen_messages');
    ?>
    <div class="wrap">
        <h1><?php echo esc_html(get_admin_page_title()); ?></h1>
        <form action="options.php" method="post">
            <?php
            settings_fields('citegen_settings');
            ?>
            <table class="form-table">
                <tr valign="top">
                    <th scope="row">Auto-show Citation After Post</th>
                    <td>
                        <label>
                            <input type="checkbox" name="citegen_auto_show" value="1" <?php checked(get_option('citegen_auto_show', true), true); ?> />
                            Automatically display citation box after post/page content
                        </label>
                        <p class="description">When disabled, use shortcode [citegen] to display citations manually</p>
                    </td>
                </tr>
                <tr valign="top">
                    <th scope="row">UI Preset</th>
                    <td>
                        <select name="citegen_ui_preset">
                            <option value="default" <?php selected(get_option('citegen_ui_preset', 'default'), 'default'); ?>>Default</option>
                            <option value="minimal" <?php selected(get_option('citegen_ui_preset', 'default'), 'minimal'); ?>>Minimal</option>
                            <option value="academic" <?php selected(get_option('citegen_ui_preset', 'default'), 'academic'); ?>>Academic</option>
                            <option value="modern" <?php selected(get_option('citegen_ui_preset', 'default'), 'modern'); ?>>Modern</option>
                        </select>
                        <p class="description">Choose the visual style for the citation box</p>
                    </td>
                </tr>
            </table>
            <?php submit_button(); ?>
        </form>
        
        <div style="margin-top: 30px; padding: 20px; background: #f0f0f1; border-left: 4px solid #2271b1;">
            <h2>Usage Instructions</h2>
            <h3>Shortcode</h3>
            <p>Use the shortcode <code>[citegen]</code> anywhere in your post or page content to display the citation box.</p>
            <p><strong>Example:</strong> <code>[citegen]</code></p>
            
            <h3>UI Presets</h3>
            <ul>
                <li><strong>Default:</strong> Standard WordPress-style citation box</li>
                <li><strong>Minimal:</strong> Clean, simple design with minimal borders</li>
                <li><strong>Academic:</strong> Professional scholarly appearance</li>
                <li><strong>Modern:</strong> Contemporary design with shadows and rounded corners</li>
            </ul>
        </div>
    </div>
    <?php
}


function citegen_author_format($user, $style)
{
    $first_name = $user->first_name;
    $last_name = $user->last_name;
    $display_name = $user->display_name;
    if (!$first_name || !$last_name) {
        $parts = explode(' ', trim($display_name));
        if (count($parts) >= 2) {
            $first_name = $parts[0];
            $last_name = $parts[count($parts) - 1];
        }
    }
    if ($last_name && $first_name) {
        if ($style === 'apa') {
            return ($last_name ?? '') . ', ' . mb_substr($first_name ?? '', 0, 1) . '.';
        } else {
            return ($last_name ?? '') . ', ' . ($first_name ?? '');
        }
    } else {
        return ($display_name ?? '');
    }
}

// Generate base citation with HTML and plain text versions
function generate_base_citation($post, $style)
{
    $author = '';
    $authors = [];

    if (function_exists('get_coauthors')) { // Check if co-authors plugin is active
        $coauthors = get_coauthors($post->ID);
        foreach ($coauthors as $user) {
            $authors[] = citegen_author_format($user, $style);
        }
    } else {
        $user = get_userdata($post->post_author); // Default to post author
        if ($user) {
            $authors[] = citegen_author_format($user, $style);
        }
    }

    // Format author string based on style and number of authors
    if ($style === 'apa') {
        if (count($authors) > 1) {
            $last = array_pop($authors);
            $author = implode(', ', $authors) . ', & ' . $last;
        } else {
            $author = $authors[0] ?? '';
        }
    } else { // MLA
        if (count($authors) > 1) {
            $author = $authors[0] . ' et al.';
        } else {
            $author = $authors[0] ?? '';
        }
    }
    $title = get_the_title($post);
    $site_name = get_bloginfo('name');
    $url = wp_get_shortlink($post);
    if ($style === 'apa') {
        // APA 7th Edition Format: Author, A. A. (Year, Month Day). Title of work. Site Name. URL
        $date = '(' . get_the_date('Y, F j', $post) . ')';
        $html = esc_html($author) . ' ' . $date . '. ' . esc_html($title) . '. ' . esc_html($site_name) . '. <a href="' . esc_url($url) . '">' . esc_html($url) . '</a>';
        $text = $author . ' ' . $date . '. ' . $title . '. ' . $site_name . '. ' . $url;
    } else if ($style === 'mla') {
        // MLA 9th Edition Format: Author. "Title of Work." Site Name, Day Month Year, URL.
        $date = get_the_date('j F Y', $post);
        $html = esc_html($author) . '. "' . esc_html($title) . '." <i>' . esc_html($site_name) . '</i>, ' . $date . ', <a href="' . esc_url($url) . '">' . esc_html($url) . '</a>.';
        $text = $author . '. "' . $title . '." ' . $site_name . ', ' . $date . ', ' . $url . '.';
    }
    return ['html' => $html, 'text' => $text];
}

// Generate citation HTML
function citegen_generate_html($post = null)
{
    if (!$post) {
        global $post;
    }
    
    $apa = generate_base_citation($post, 'apa');
    $mla = generate_base_citation($post, 'mla');
    $preset = get_option('citegen_ui_preset', 'default');
    
    $citation_html = '<div class="citegen-citation-wrapper citegen-preset-' . esc_attr($preset) . '" data-apa-html="' . esc_attr($apa['html']) . '" data-apa-text="' . esc_attr($apa['text']) . '" data-mla-html="' . esc_attr($mla['html']) . '" data-mla-text="' . esc_attr($mla['text']) . '">';
    $citation_html .= '<div class="citegen-citation" contenteditable="true" style="width:100%;min-height:3em;border:1px solid #ccc;padding:8px 5px;background:#f9f9f9;border-radius:6px;margin-bottom:5px;">Citation is loading...</div>';
    $citation_html .= '<div class="citegen-controls">';
    $citation_html .= '<div class="citegen-style">';
    $citation_html .= '<label for="citegen-style-select">Citation style: </label>';
    $citation_html .= '<select id="citegen-style-select" class="citegen-style-select"><option value="apa">APA</option><option value="mla">MLA</option></select>';
    $citation_html .= '</div>';
    $citation_html .= '<button class="citegen-copy-button">Copy Citation</button>';
    $citation_html .= '</div>';
    $citation_html .= '</div>';
    
    return $citation_html;
}

function citegen_append_citation($content)
{
    // Only auto-append if setting is enabled
    if (!get_option('citegen_auto_show', true)) {
        return $content;
    }
    
    if (is_singular(['post', 'page'])) {
        global $post;
        $content = $content . citegen_generate_html($post);
    }
    return $content;
}
add_filter('the_content', 'citegen_append_citation');

// Shortcode support
function citegen_shortcode($atts)
{
    if (is_singular(['post', 'page'])) {
        global $post;
        return citegen_generate_html($post);
    }
    return '';
}
add_shortcode('citegen', 'citegen_shortcode');

// Enqueue scripts and styles
function citegen_enqueue_assets()
{
    wp_enqueue_script('citegen-script', plugins_url('citegen.js', __FILE__), [], '2.0', true);
    wp_enqueue_style('citegen-style', plugins_url('citegen.css', __FILE__), [], '2.0');
    
    // Pass preset to JavaScript
    wp_localize_script('citegen-script', 'citegenData', [
        'preset' => get_option('citegen_ui_preset', 'default')
    ]);
}
add_action('wp_enqueue_scripts', 'citegen_enqueue_assets');