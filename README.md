# TicketBear

### A custom ticket resolution system developed for the University of Utah Campus Store, distributed as a Laravel package.

## Installation
1. Edit your project's `composer.json` file to indicate this repository:
`"repositories": [
	{
			"type": "vcs",
			"url": "https://github.com/accellarando/TicketBear"
	}
]`
2. `composer require accellarando/ticketbear`
3. Edit `vendor/accellarando/ticketbear/src/files/config.php` to set up various constants unique to your installation.
4. Set up database connections etc in .env, if you haven't already.
5. Run `php artisan ticketbear:install` to move some files around, use my pre-designed views, and run migrations.
6. Edit the new controller placed in app/Http/Controllers/IssueController to customize how you want to handle tickets.

## Usage
Configure and install the package. Create a form. Use the form. Use my views if you don't want to design your own.

## Configuration
See `vendor/accellarando/ticketbear/src/files/config.php` for thorough documentation on what every configuration flag does.

You can edit these values after initial installation, but you may need to re-run TicketBear migrations for everything to work properly.

## Credits
Originally Developed for the Textbooks Department at the University of Utah Campus Store, to keep track of Inclusive Access issues. 

Also used in their IT department to track service tickets.
