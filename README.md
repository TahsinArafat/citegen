<div align="center">
  <h1>CiteGen</h1>
  <p><strong>WordPress Plugin for Automatic APA & MLA Citations</strong></p>
  <p>
    <a href="https://github.com/TahsinArafat/citegen"><img src="https://img.shields.io/badge/WordPress-Plugin-blue?logo=wordpress" alt="WordPress Plugin"></a>
  </p>
</div>

---

## Overview

**CiteGen** is a WordPress plugin that automatically generates APA and MLA citations for posts and pages. It supports multiple authors (via the [Co-Authors Plus](https://wordpress.org/plugins/co-authors-plus/) plugin), allows users to select citation style, and provides a one-click copy feature. Citations are always up-to-date and include the access date and time.

**Current Version:** 2.0

---

## Features

- 📚 **Internationally Correct APA 7th & MLA 9th Edition** citation formats
- ⚙️ **Admin Settings Page** - Configure plugin behavior from WordPress admin panel
- 🔄 **Auto-show Toggle** - Choose to automatically display citations or use shortcode
- 📝 **Shortcode Support** - Use `[citegen]` to place citations anywhere
- 🎨 **4 Customizable UI Presets** - Default, Minimal, Academic, and Modern styles
- 👥 **Multiple Author Support** (with Co-Authors Plus plugin)
- 📋 **One-Click Copy** (plain text citation)
- 🕒 **Access Date and Time** included in citation
- ✨ **Modern, Responsive UI**

---

## Installation

1. **Download** or clone this repository:
   ```sh
   git clone https://github.com/TahsinArafat/citegen.git
   ```
2. **Copy** the `citegen` folder into your WordPress `wp-content/plugins/` directory.
3. **Activate** the plugin from the WordPress admin dashboard.
4. *(Optional)* Install and activate [Co-Authors Plus](https://wordpress.org/plugins/co-authors-plus/) for multi-author support.

---

## Usage

### Automatic Display
By default, the plugin automatically appends a citation box to all posts and pages. You can disable this in the settings.

### Shortcode
Use the shortcode `[citegen]` anywhere in your post or page content:
```
This is my content...

[citegen]
```

### Settings Page
Navigate to **Settings > CiteGen** in WordPress admin to configure:
- **Auto-show Citation After Post** - Toggle automatic display
- **UI Preset** - Choose from 4 visual styles

### UI Presets
1. **Default** - Standard WordPress-style citation box
2. **Minimal** - Clean, simple design with minimal borders
3. **Academic** - Professional scholarly appearance
4. **Modern** - Contemporary design with gradients and shadows

---

## Citation Formats

### APA 7th Edition
Format: `Author, A. A. (Year, Month Day). Title of work. Site Name. URL Retrieved Month Day, Year, Time.`

Example:
```
Smith, J. (2026, January 12). Understanding WordPress Plugins. My Blog. https://example.com/post Retrieved January 12, 2026, 3:45 PM.
```

### MLA 9th Edition
Format: `Author. "Title of Work." Site Name, Day Month Year, URL. Accessed Day Month Year, Time.`

Example:
```
Smith, John. "Understanding WordPress Plugins." My Blog, 12 January 2026, https://example.com/post. Accessed 12 January 2026, 3:45 PM.
```

---

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- Optional: Co-Authors Plus plugin for multiple authors

---

## Changelog

### Version 2.0
- ✅ Verified internationally correct APA 7th and MLA 9th edition formats
- ✅ Added admin settings page (Settings > CiteGen)
- ✅ Added auto-show toggle option
- ✅ Implemented shortcode `[citegen]`
- ✅ Added 4 customizable UI presets
- ✅ Improved citation accuracy with proper retrieval/access statements

### Version 1.2.Beta
- Initial release with basic APA/MLA support

---

## Support

For issues, questions, or contributions, please visit the [GitHub repository](https://github.com/TahsinArafat/citegen).

---

## License

This plugin is open source and available under the GPL v2 or later license.

---

## Author

Developed by [Tahsin Arafat](https://github.com/TahsinArafat)| APA Style | MLA Style |
|-----------|-----------|
| ![APA Example](https://user-images.githubusercontent.com/placeholder/apa-example.png) | ![MLA Example](https://user-images.githubusercontent.com/placeholder/mla-example.png) |

--- -->

## Customization

- To change the appearance, edit `citegen.css`.
- To modify citation logic, see `citegen.php`.
- For UI/UX tweaks, edit `citegen.js`.

---

## Requirements

- WordPress 5.0 or higher
- PHP 7.0 or higher
- *(Optional)* [Co-Authors Plus](https://wordpress.org/plugins/co-authors-plus/) plugin

---

## Credits

- **Author:** [Tahsin Arafat](https://github.com/TahsinArafat)
- **Co-Authors Plus:** [Automattic](https://github.com/Automattic/Co-Authors-Plus)

---

## Contributing

Pull requests and suggestions are welcome! Please open an issue to discuss changes before submitting a PR.

---

## Support

For questions or support, please open an issue on [GitHub](https://github.com/TahsinArafat/citegen/issues).
