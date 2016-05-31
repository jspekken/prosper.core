<?php

/**
 * This file is part of the Prosper/Core package.
 *
 * (c) Jelle Spekken <jspekken@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

return [

    'controllers' => [
        'pages' => Prosper\Core\Admin\Controllers\PageController::class
    ],

    'fields' => [
        /*
         * Text fields.
         */
        'auto-link' => Prosper\Core\Admin\Fields\AutoLinkField::class,
        'label'     => Prosper\Core\Admin\Fields\LabelField::class,

        /*
         * Input fields.
         */
        'input.checkbox'  => Prosper\Core\Admin\Fields\Input\CheckboxField::class,
        'input.date'      => Prosper\Core\Admin\Fields\Input\DateField::class,
        'input.date-time' => Prosper\Core\Admin\Fields\Input\DateTimeField::class,
        'input.email'     => Prosper\Core\Admin\Fields\Input\EmailField::class,
        'input.file'      => Prosper\Core\Admin\Fields\Input\FileField::class,
        'input.image'     => Prosper\Core\Admin\Fields\Input\ImageField::class,
        'input.number'    => Prosper\Core\Admin\Fields\Input\NumberField::class,
        'input.password'  => Prosper\Core\Admin\Fields\Input\PasswordField::class,
        'input.select'    => Prosper\Core\Admin\Fields\Input\SelectField::class,
        'input.textarea'  => Prosper\Core\Admin\Fields\Input\TextareaField::class,
        'input.text'      => Prosper\Core\Admin\Fields\Input\TextField::class,
        'input.time'      => Prosper\Core\Admin\Fields\Input\TimeField::class,

        /*
         * Fields targeting relationships.
         */
        'relation.belongs-to'      => Prosper\Core\Admin\Fields\Relations\BelongsToField::class,
        'relation.belongs-to-many' => Prosper\Core\Admin\Fields\Relations\BelongsToManyField::class,
        'relation.has-many'        => Prosper\Core\Admin\Fields\Relations\HasManyField::class
    ]
];