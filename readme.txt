=== CiteGen ===
Contributors: tahsinarafat
Tags: citation, apa, mla, academic, bibliography
Requires at least: 5.0
Tested up to: 6.4
Requires PHP: 7.0
Stable tag: 2.0
License: GPLv2 or later
License URI: https://www.gnu.org/licenses/gpl-2.0.html

Automatically generate APA and MLA citations for WordPress posts and pages with customizable styles and one-click copy functionality.

== Description ==

**CiteGen** is a WordPress plugin that automatically generates professionally formatted APA 7th Edition and MLA 9th Edition citations for your posts and pages. Perfect for academic blogs, research websites, educational institutions, and content creators who need proper citations.

= Key Features =

* **Internationally Correct Citations** - Follows APA 7th Edition and MLA 9th Edition standards
* **Admin Settings Page** - Easy-to-use settings panel for configuring plugin behavior
* **Auto-show Toggle** - Choose to automatically display citations or use shortcode
* **Shortcode Support** - Use `[citegen]` to place citations anywhere in your content
* **4 Customizable UI Presets** - Default, Minimal, Academic, and Modern visual styles
* **Multiple Authors Support** - Compatible with Co-Authors Plus plugin
* **One-Click Copy** - Copy citation to clipboard with a single click
* **Real-time Access Date** - Automatically includes current date and time accessed
* **Responsive Design** - Works perfectly on all devices and screen sizes

= Citation Formats =

**APA 7th Edition Format:**
Author, A. A. (Year, Month Day). Title of work. Site Name. URL Retrieved Month Day, Year, Time.

**MLA 9th Edition Format:**
Author. "Title of Work." Site Name, Day Month Year, URL. Accessed Day Month Year, Time.

= Usage =

After activation, citations automatically appear after your post/page content. You can:

1. **Automatic Display** - Citations show automatically (default setting)
2. **Manual Placement** - Disable auto-display and use `[citegen]` shortcode
3. **Customize Appearance** - Choose from 4 UI presets in Settings > CiteGen

= UI Presets =

1. **Default** - Standard WordPress-style citation box
2. **Minimal** - Clean, simple design with minimal borders
3. **Academic** - Professional scholarly appearance with serif fonts
4. **Modern** - Contemporary design with blue accents and gradients

== Installation ==

1. Upload the `citegen` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Configure settings at Settings > CiteGen (optional)
4. (Optional) Install Co-Authors Plus plugin for multiple author support

== Frequently Asked Questions ==

= Does this work with custom post types? =

Currently, CiteGen works with standard posts and pages. Custom post type support may be added in future versions.

= Can I use both automatic display and shortcode? =

Yes! Keep auto-display enabled for most content, and use the `[citegen]` shortcode for specific placement when needed.

= Is this compatible with Co-Authors Plus? =

Yes! CiteGen automatically detects and formats multiple authors when Co-Authors Plus is installed and active.

= Can I customize the citation format? =

The citation formats follow international APA 7th and MLA 9th edition standards. UI styling can be customized using the 4 available presets.

= Does this work with page builders? =

Yes! The shortcode `[citegen]` works with most page builders including Elementor, Beaver Builder, and Gutenberg.

== Screenshots ==

1. Citation box with APA format (Default preset)
2. Citation box with MLA format (Minimal preset)
3. Admin settings page
4. Academic preset styling
5. Modern preset styling

== Changelog ==

= 2.0 =
* Added: GPL v2 license declaration
* Added: Admin settings page (Settings > CiteGen)
* Added: Auto-show toggle option
* Added: Shortcode support `[citegen]`
* Added: 4 customizable UI presets (Default, Minimal, Academic, Modern)
* Fixed: APA 7th Edition format compliance (removed italics from site name, added "Retrieved")
* Fixed: MLA 9th Edition format with proper "Accessed" statements
* Fixed: Function naming to follow WordPress coding standards
* Improved: Security with nonce verification
* Improved: Code organization and documentation

= 1.2.Beta =
* Initial public release
* Basic APA and MLA citation generation
* Multiple author support with Co-Authors Plus
* Copy to clipboard functionality
* Responsive design

== Upgrade Notice ==

= 2.0 =
Major update with new admin settings, shortcode support, and 4 UI presets. Improved citation accuracy and WordPress.org compliance.

== License ==

This plugin is free software: you can redistribute it and/or modify it under the terms of the GNU General Public License as published by the Free Software Foundation, either version 2 of the License, or any later version.

This plugin is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the GNU General Public License for more details.

You should have received a copy of the GNU General Public License along with this plugin. If not, see https://www.gnu.org/licenses/gpl-2.0.html.
