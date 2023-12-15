<img src="https://www.seven.io/wp-content/uploads/Logo.svg" width="250" />

Send SMS to your customers via seven.

# Installation

## Manually
* Download the latest release from [GitHub](http://github.com/seven-io/thelia/releases/latest/download/seven-telia-latest.zip).
* Extract the archive into the modules folder `unzip -d <thelia_root>/local/modules/`.

## Composer
Execute from inside your thelia installation root:

`composer require seven.io/thelia`

## Usage

After installation, enable the module and fill in your API key in the module settings.

### Send bulk SMS
Go to *Customers*, click *Bulk SMS* and fill out the form to fit your needs.
After clicking *Send*, the messages get sent to the customers.

### Filters
- *Reseller* Narrow down customer search to include only resellers

### Placeholders

Each customer property can be accessed via placeholders.
Examples: 

* {{firstname}} resolves to the customers first name
* {{lastname}} resolves to the customers last name

#### Support

Need help? Feel free to [contact us](https://www.seven.io/en/company/contact/).

[![MIT](https://img.shields.io/badge/License-MIT-teal.svg)](LICENSE)
