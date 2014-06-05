# Fuel LbConfig Module

This module is used to manage the Lb Fuel Config Package
You can install the Fuel LbConfig package here : [Click here](https://github.com/jhuriez/fuel-lbConfig-package)

You may have bugs on this module, it's not completely finished. Furthermore, it's difficult to automatically adapted a module on an existing project.
This module can  be used as a basis to create your own section to manage the Fuel LbConfig Package.

# Features

* Manage all config easily
* Easy integration in your Theme
* Use jQuery and Bootstrap 3

# Installation

1. This module uses Theme class, you must create your theme folder.
2. You need to install the Lb Package : [See more](http://github.com/jhuriez/fuel-lb-package)
2. You need to install the LbConfig Package : [See more](http://github.com/jhuriez/fuel-lbConfig-package)
3. Clone or download the fuel-module-config repository
4. Move it into your module folder, and rename it to "config"

# Configuration

## Base controller

This module is not securised, i've not added a ACL or Auth security. You need to attach this module on your base admin controller :

In `modules/config/classes/controller/backend.php` at line 5 :

```php
  class Controller_Backend extends \Controller_Base_Backend
```

You can see an example of a simple controller using theme here : [`example/simple_controller.php`](http://github.com/jhuriez/fuel-lb-package/blob/master/example/simple_controller.php)

## Theme

It uses the Theme class from FuelPHP, consequently you need to have a theme for your administration.

You need to load jQuery and jQuery UI, and optionnaly Twitter Bootstrap v3 + Font Awesome
For this, see the docs in Lb Package wiki : [Here](http://github.com/jhuriez/fuel-lb-package/blob/master/wiki/theme.md)

## Implementation

All variables used in the template file from theme :

* $pageTitle : For the title of the page in any action
* $partials['content'] : The partial for the content
* `<?= \Theme::instance()->asset->render('css_plugin'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_core'); ?>` in the head
* `<?= \Theme::instance()->asset->render('js_plugin'); ?>` in the footer

You can see an example of template here : [`example/template.php`](http://github.com/jhuriez/fuel-lb-package/blob/master/example/template.php)


# Usage

Access the backoffice at : http://your-fuel-url/config/backend

# Error

- Fuel\Core\ThemeException [ Error ]: Theme "default" could not be found.
It's because this module uses Themes for better flexibility. You must create a theme folder, by default it's DOCROOT/themes/default.

- ErrorException [ Fatal Error ]: Class 'Controller_Base_Backend' not found.
It's because the controller \Config\Controller_Backend need to extends your admin controller in your project. In my case, the admin controller is named Controller_Base_Backend

# Override Theme

Views module use Twitter bootstrap 3 tags for the UI. And FontAwesome

You can override them easily. For example for override the view 'config/views/backend/index.php', you need to create the same file here "DOCROOT/themes/[your_theme]/config/backend/index.php"

# Screenshots

1. [Manage configs](http://i.imgur.com/OTO1J9q.png)
