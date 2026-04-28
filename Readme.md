<p align="center">
  <img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" alt="seven logo" />
</p>

<h1 align="center">seven SMS for Thelia</h1>

<p align="center">
  Send bulk SMS to your <a href="https://thelia.net/">Thelia</a> customers via the seven gateway.
</p>

<p align="center">
  <a href="LICENSE"><img src="https://img.shields.io/badge/License-MIT-teal.svg" alt="MIT License" /></a>
  <img src="https://img.shields.io/badge/Thelia-2.x-blue" alt="Thelia 2.x" />
  <img src="https://img.shields.io/badge/PHP-7.0%2B-purple" alt="PHP 7.0+" />
  <a href="https://packagist.org/packages/seven.io/thelia"><img src="https://img.shields.io/packagist/v/seven.io/thelia" alt="Packagist" /></a>
</p>

---

## Features

- **Bulk SMS** - Reach all customers (or a filtered subset) in one go
- **Reseller Filter** - Limit recipients to reseller-type customers
- **Property Placeholders** - Use `{{firstname}}`, `{{lastname}}` (or any customer property) in the message body

## Prerequisites

- [Thelia](https://thelia.net/) 2.x
- PHP 7.0+
- A [seven account](https://www.seven.io/) with API key ([How to get your API key](https://help.seven.io/en/developer/where-do-i-find-my-api-key))

## Installation

### Composer (recommended)

```bash
cd /path/to/thelia/root
composer require seven.io/thelia
```

### Manual

1. Download the [latest release](https://github.com/seven-io/thelia/releases/latest/download/seven-telia-latest.zip).
2. Extract it into the modules folder:

   ```bash
   unzip -d <thelia_root>/local/modules/ seven-telia-latest.zip
   ```

## Configuration

In the Thelia admin, enable the *seven* module and paste your seven API key into the module settings.

## Usage

### Send bulk SMS

1. Go to **Customers**.
2. Click **Bulk SMS**.
3. Compose the message and apply filters (e.g. *Reseller*).
4. Click **Send**.

### Placeholders

Reference any customer property in the message body using `{{property_name}}`:

```
Hi {{firstname}} {{lastname}}, your order is on its way!
```

Unresolved placeholders remain as plain text in the outgoing SMS.

## Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/) or [open an issue](https://github.com/seven-io/thelia/issues).

## License

[MIT](LICENSE)
