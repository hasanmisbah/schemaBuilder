<?php

namespace Hasanmisbah\SchemaBuilder;

class Schema
{
    public static function create($tableName, callable $callback)
    {
        $charsetCollate = DB::instance()->get_charset_collate();
        $blueprint = new Blueprint($tableName, $charsetCollate, DB::instance()->prefix);
        $callback($blueprint);
        (new Schema)->execute($blueprint);
    }

    public function execute(Blueprint $bluePrint)
    {
        DB::instance()->query($bluePrint->toSql());
    }
}
