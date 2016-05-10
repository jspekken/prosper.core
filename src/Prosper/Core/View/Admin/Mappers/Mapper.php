<?php

namespace Prosper\Core\View\Admin\Mappers;

abstract class Mapper
{

    protected $fields;

    public function __construct()
    {
        $this->fields = collect();
    }

    public function add($type, array $arguments)
    {
        $namespace = config('prosper.admin.fields.' . $type);

        $this->fields->put($arguments['name'], new $namespace($arguments));

        return $this;
    }
}