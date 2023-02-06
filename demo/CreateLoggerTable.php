<?php

namespace Database;

use Hasanmisbah\SchemaBuilder\Blueprint;
use Hasanmisbah\SchemaBuilder\Schema;

class CreateLoggerTable implements MigrationConcern
{

    public static function migrate()
    {
        Schema::create('demo_table', function(Blueprint $table){
            $table->id();
            $table->bigInteger('site_id')->nullable();
            $table->bigInteger('alert_id')->nullable();
            $table->string('client_ip')->nullable();
            $table->string('severity')->nullable();
            $table->string('object')->nullable();
            $table->string('event_type')->nullable();
            $table->longText('user_agent')->nullable();
            $table->longText('description')->nullable();
            $table->bigInteger('user_id')->nullable();
            $table->string('user_name')->nullable();
            $table->string('user_roles')->nullable();
            $table->string('post_status')->nullable();
            $table->string('post_type')->nullable();
            $table->string('post_id')->defaultValue('1');
        });
    }
}
