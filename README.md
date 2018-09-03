Organic Contact Form
====================
Tested up to: 4.9.8
Stable tag: master
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Simple contact form plugin that can be used to display a contact form on any page. Use the shortcode [organic-contact-form] to include on a page.

Description
-----------

This plugin allows you to add a configurable contact form to any page of your Wordpress site. It features Google reCaptcha options for security, and both client and server-side validation. Within the Wordpress backend, you can view and download a CSV of submissions, along with controls to allow you to add or edit form fields.

Installation
------------

This section describes how to install the plugin and get it working.

1. Upload `organic-contact-form.zip` from the `dist` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress

Frequently Asked Questions
--------------------------

### Can I have more than one contact form on a single page?

No, the plugin doesn't currently support this.

### What version of Google reCaptcha does it support?

Currently, it only supports invisible reCaptcha v2

Documentation
-------------

View the wiki in the Github repo for user documentation: https://github.com/joewebber/Organic-Contact-Form/wiki

Changelog
---------

### 1.0
* First stable release

Developers
----------

The plugin uses the following:

WordPress Plugin Boilerplate - https://github.com/DevinVinson/WordPress-Plugin-Boilerplate

To compile the SASS and minify the JS, ensure that you are using the latest version of Node and npm, and run the following from the root of the repo:

`npm install`

Once you have done this, the gulp tasks will take care of compiling and minifying code:

`gulp`

When you are ready to depoly the plugin, use the following to output a zip to the `dist` folder:

`sh package.sh` (requires zip)
