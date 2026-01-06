# Lead Capture CRM Lite

Lead Capture CRM Lite is a WordPress plugin designed to help you capture leads effectively and manage them through a user-friendly interface. This plugin provides essential features for lead management, including a customizable lead capture form, settings for email notifications, and a straightforward admin dashboard.

## Features

- **Lead Capture Form**: Easily embed a lead capture form on your website using a shortcode or Gutenberg block.
- **Admin Dashboard**: Manage leads from a dedicated admin page, view lead details, and export leads as CSV.
- **Settings Configuration**: Configure admin email notifications, webhook URLs, and rate limits from the settings page.
- **REST API Support**: Access lead data programmatically through a REST API endpoint.
- **Translation Ready**: The plugin is translation-ready with a .pot file included for easy localization.

## Installation

1. **Download the Plugin**: Download the plugin zip file from the WordPress repository or GitHub.
2. **Upload the Plugin**: Go to your WordPress admin panel, navigate to Plugins > Add New > Upload Plugin, and upload the zip file.
3. **Activate the Plugin**: After uploading, activate the plugin from the Plugins menu.
4. **Configure Settings**: Navigate to the plugin settings page to configure your preferences.

## Usage

- **Embedding the Lead Capture Form**: Use the shortcode `[lead_capture_form]` to display the lead capture form on any post or page.
- **Accessing the Admin Dashboard**: Go to the Leads section in the WordPress admin menu to manage your captured leads.

## Development

To contribute to the development of Lead Capture CRM Lite, follow these steps:

1. Clone the repository:
   ```
   git clone https://github.com/yourusername/lead-capture-crm-lite.git
   ```
2. Navigate to the project directory:
   ```
   cd lead-capture-crm-lite
   ```
3. Install PHP dependencies:
   ```
   composer install
   ```
4. Install JavaScript dependencies:
   ```
   npm install
   ```
5. Start the local development environment:
   ```
   docker-compose up
   ```

## Testing

To run the tests, use the following command:
```
vendor/bin/phpunit
```

## Contributing

We welcome contributions! Please fork the repository and submit a pull request for any enhancements or bug fixes.

## License

This plugin is licensed under the MIT License. See the LICENSE file for more details.

## Changelog

See the CHANGELOG.md file for a list of changes and updates to the plugin.

## Support

For support, please open an issue on the GitHub repository or contact us through the WordPress support forums.