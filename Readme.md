![Sms77.io Logo](https://www.sms77.io/wp-content/uploads/2019/07/sms77-Logo-400x79.png "Sms77.io Logo")

Send SMS to your customers via Sms77.io.

# Installation

## Manually
* Download the latest release from [GitHub](http://github.com/sms77io/thelia/releases/latest/download/sms77-telia-latest.zip).
* Extract the archive into the modules folder `unzip -d <thelia_root>/local/modules/`.

## Composer
Execute from inside your thelia installation root:

`composer require sms77/thelia`

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

Need help? Feel free to [contact us](https://www.sms77.io/en/company/contact/).

[![MIT](https://img.shields.io/badge/License-MIT-teal.svg)](./LICENSE)
