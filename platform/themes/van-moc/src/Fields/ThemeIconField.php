<?php

namespace Theme\\VanMoc\Fields;

use Assets;
use Kris\LaravelFormBuilder\Fields\FormField;
use Theme;

class ThemeIconField extends FormField
{
    /**
     * {@inheritDoc}
     */
    protected function getTemplate()
    {
        Assets::addScriptsDirectly(Theme::asset()->url('js/icons-field.js'));

        return Theme::getThemeNamespace() . '::partials.fields.icons-field';
    }
}
