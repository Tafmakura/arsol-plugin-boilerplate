# ARSOL Plugin Boilerplate

A modern WordPress plugin boilerplate for ARSOL projects.

## Description

This boilerplate provides a solid foundation for building WordPress plugins with modern development practices. It includes:

- Autoloading classes
- Organized file structure
- Admin interface setup
- Asset management
- Internationalization support

## Requirements

- WordPress 5.8 or higher
- PHP 7.4 or higher

## Installation

1. Clone this repository into your WordPress plugins directory:
```bash
cd wp-content/plugins
git clone https://github.com/your-username/arsol-plugin-boilerplate.git
```

2. Activate the plugin through the WordPress admin interface or via WP-CLI:
```bash
wp plugin activate arsol-plugin-boilerplate
```

## Development

### File Structure

```
arsol-plugin-boilerplate/
├── assets/          # CSS, JS, and images
├── includes/        # PHP classes and functions
│   ├── classes/     # Class files
│   ├── functions/   # Function files
│   └── ui/         # UI components
└── languages/      # Translation files
```

### Adding New Features

1. Create new classes in the `includes/classes` directory
2. Add functions in the `includes/functions` directory
3. Add assets in the `assets` directory

## Contributing

1. Fork the repository
2. Create your feature branch
3. Commit your changes
4. Push to the branch
5. Create a new Pull Request

## License

This project is licensed under the GPL v2 or later.

## Credits

Developed by ARSOL 