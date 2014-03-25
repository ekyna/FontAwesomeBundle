FontAwesomeBundle
=================

[FortAwesome/Font-Awesome](https://github.com/FortAwesome/Font-Awesome.git) integration for Symfony2.
- Fonts installation
- Preconfigured asset

Composer installation:
```json
{
    "require": {
        "ekyna/fontawesome-bundle": "0.1.*@dev"
    },
    "scripts": {
        "post-install-cmd": [
            "Ekyna\\FontAwesomeBundle\\Composer\\ScriptHandler::install"
        ],
        "post-update-cmd": [
            "Ekyna\\FontAwesomeBundle\\Composer\\ScriptHandler::install"
        ]
    },
}
```

Register bundle in kernel:
```php
// app/AppKernel.php
class AppKernel extends Kernel
{
    public function registerBundles()
    {
        $bundles = array(
            ...
            new Ekyna\FontAwesomeBundle\EkynaFontAwesomeBundle()
        );
    }
}
```

Fonts installation without composer script handler:
`php app:console ekyna:fontawesome:install`

Configuration (optionnal, default values)
```yaml
# app/config/config.yml
ekyna_fontawesome:
    output_dir: ~
    assets_dir: %kernel.root_dir%/../vendor/fortawesome/font-awesome
    configure_assetic: true
```

Use in a twig template:
```twig
{% stylesheets output='css/backend.css' filter='cssrewrite, ?yui_css'
    ...
    'css/fontawesome.css'
    ...
%}
    <link href="{{ asset_url }}" rel="stylesheet" type="text/css" />
{% endstylesheets %}
```