<?php
/*
Plugin Name: CiteGen
Description: Automatically generates APA and MLA citations for posts and pages with style selection and copy functionality. This plugin is supported by the Co-Authors Plus plugin for multiple authors.
Version: 1.2.Beta
Author URI: https://github.com/TahsinArafat
Author: Tahsin Arafat
*/

// Exit if accessed directly outside of WordPress
if (!defined('ABSPATH')) {
    exit;
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
        $date = '(' . get_the_date('Y, F j', $post) . ')';
        $html = esc_html($author) . ' ' . $date . '. ' . esc_html($title) . '. <i>' . esc_html($site_name) . '</i>. <a href="' . esc_url($url) . '">' . esc_html($url) . '</a>';
        $text = $author . ' ' . $date . '. ' . $title . '. ' . $site_name . '. ' . $url;
    } else if ($style === 'mla') {
        $date = get_the_date('j F Y', $post);
        $html = esc_html($author) . '. "' . esc_html($title) . '." <i>' . esc_html($site_name) . '</i>, ' . $date . ', <a href="' . esc_url($url) . '">' . esc_html($url) . '</a>.';
        $text = $author . '. "' . $title . '." ' . $site_name . ', ' . $date . ', ' . $url . '.';
    }
    return ['html' => $html, 'text' => $text];
}

function citegen_append_citation($content)
{
    if (is_singular(['post', 'page'])) {
        global $post;
        $apa = generate_base_citation($post, 'apa');
        $mla = generate_base_citation($post, 'mla');
        $citation_html = '<div class="citegen-citation-wrapper" data-apa-html="' . esc_attr($apa['html']) . '" data-apa-text="' . esc_attr($apa['text']) . '" data-mla-html="' . esc_attr($mla['html']) . '" data-mla-text="' . esc_attr($mla['text']) . '">';
        $citation_html .= '<div class="citegen-citation" contenteditable="true" style="width:100%;min-height:3em;border:1px solid #ccc;padding:8px 5px;background:#f9f9f9;border-radius:6px;margin-bottom:5px;">Citation is loading...</div>';
        $citation_html .= '<div class="citegen-controls">';
        $citation_html .= '<div class="citegen-style">';
        $citation_html .= '<label for="citegen-style-select">Citation style: </label>';
        $citation_html .= '<select id="citegen-style-select" class="citegen-style-select"><option value="apa">APA</option><option value="mla">MLA</option></select>';
        $citation_html .= '</div>';
        $citation_html .= '<button class="citegen-copy-button">Copy Citation</button>';
        $citation_html .= '</div>';
        $citation_html .= '</div>';
        $content = $content . $citation_html;
    }
    return $content;
}
add_filter('the_content', 'citegen_append_citation');

// Enqueue scripts and styles
function citegen_enqueue_assets()
{
    wp_enqueue_script('citegen-script', plugins_url('citegen.js', __FILE__), [], '1.1', true);
    wp_enqueue_style('citegen-style', plugins_url('citegen.css', __FILE__), [], '1.2');
}
add_action('wp_enqueue_scripts', 'citegen_enqueue_assets');