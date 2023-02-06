<?php

namespace Hasanmisbah\SchemaBuilder;

class DB
{
    public $instance = null;

    public function __construct()
    {
        global $wpdb;
        $this->instance = $wpdb;
    }

    public static function instance()
    {
        $instance = (new static());
        return $instance->instance;
    }
}
