# skeleton-i18n

## Description

This library enables internationalization and translation features in Skeleton.


## Installation

Installation via composer:

    composer require tigron/skeleton-i18n

Run the migrations to update the database schema:

	skeleton migrate:up

## Howto

Configure the package:

	/**
	 * The the directory to store the po files
	 */
	\Skeleton\I18n\Config::$po_directory = '/my_app/po';
	/**
	 * Define a temporary folder to cache all translations
	 */
	\Skeleton\I18n\Config::$cache_directory = '/my_app/tmp/languages';

	/**
	 * Optional:
	 * skeleton-i18n keeps translations for templates per application.
	 * For every skeleton application in your project a different po file is
	 * created that contains all strings to be translated for the given
	 * application.
	 * If for some reason, you want to include more templates, this can
	 * be done via the following configuration.
	\Skeleton\I18n\Config::$additional_template_paths['pdf'] = '/my_app/pdf/templates';

	/**
	 * Optional:
	 * Set another Language interface
	 */
	\Skeleton\I18n\Config::$language_interface = 'Language';


Use it:

Via a twig template rendered by skeleton-template-twig:

	{% trans "To be translated" %}

Directly via PHP:

	\Skeleton\I18n\Translation::translate('To be translated', 'admin');
