<?php

use Habib\Commentable\Models\Commentable;

return [
    //default true
    'default_active' => true,
    'table_name' => 'commentables',
    'morph_name' => 'commentable',
    'comment_class' => Commentable::class,
    'validate_create' => [],
    'validate_update' => [],
    'route_prefix' => '',
    'middleware' => [],
];
