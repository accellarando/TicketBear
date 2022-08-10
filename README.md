# TicketBear

### A custom ticket resolution system developed for the University of Utah Campus Store, distributed as a Laravel package.

## Installation
Try this:
1. Edit your project's `composer.json` file to indicate this repository:
`"repositories": [
	{
			"type": "vcs",
			"url": "https://github.com/accellarando/TicketBear"
	}
]`
2. `composer require accellarando/ticketbear`
3. Edit `vendor/accellarando/ticketbear/config.php` to your heart's content. (todo: read from a config file not in the vendor directory - write better documentation too)
4. Run `vendor/accellarando/ticketbear/setup.php`. This script will require a helper function in your bootstrap/app
5. (optional) If you want my fancy pre-designed views, run `php artisan vendor:publish --provider="Accellarando\TicketBear"`.

## Usage
Install the package. Create a form. Use the form. Use my views if you don't feel like designing your own.

## Features
todo: this

## Credits

Developed for the Textbooks Department at the University of Utah Campus Store, to keep track of Inclusive Access issues. (implementation in progress)

