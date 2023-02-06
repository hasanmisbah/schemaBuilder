<?php

namespace Hasanmisbah\SchemaBuilder;

interface BlueprintConcern
{
    public function __construct($tableName, $charsetCollate, $tablePrefix);

    public function addColumn($column, $type);


    public function id($name = 'id');

    public function string($column, $length = 255);

    public function index();

    public function text($column);

    public function longText($column);

    public function integer($column, $length = 11);

    public function bigInteger($column, $length = 20);

    public function unsignedBigInteger($column, $length = 20);

    public function tinyInteger($column, $length = 4);

    public function mediumInteger($column, $length = 9);

    public function smallInteger($column, $length = 6);

    public function json($column);

    public function unsignedInteger($column, $length = 11);

    public function timestamps();

    public function primary($column);

    public function unique($column);

    public function foreign($column);

    public function reference($table);

    public function comment($comment);

    public function references($table);

    public function on($column);

    public function onDelete($action);

    public function onUpdate($action);

    public function renameColumn($oldColumn, $newColumn);

    public function dropColumn($column);

    public function buildColumns();

    public function buildPrimaryKey();

    public function nullable();

    public function buildUniqueKey();

    public function buildIndexKey();

    public function buildForeignKey();

    public function buildEngine();

    public function buildAutoIncrement();

    public function buildCharset();

    public function buildCollate();

    public function buildComment();

    public function engine($engine);

    public function autoIncrement($autoIncrement);

    public function charset($charset);

    public function collate($collate);

    public function defaultCharset($defaultCharset);

    public function defaultCollate($defaultCollate);

    public function buildRenameColumns();

    public function buildDropColumns();

    public function toSql();
}
