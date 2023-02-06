<?php

namespace Database;

interface MigrationConcern
{
    public static function migrate();
}
