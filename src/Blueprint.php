<?php

namespace Hasanmisbah\SchemaBuilder;

class Blueprint implements BlueprintConcern
{
    protected $tableName = null;

    protected $columns = [];

    protected $column = null;

    protected $columnType = null;

    protected $tablePrefix = null;

    protected $charsetCollate = null;

    protected $primaryKey = null;

    protected $uniqueKey = [];

    protected $indexKey = [];

    protected $foreignKey = [];

    protected $engine = null;

    protected $autoIncrement = null;

    protected $defaultCharset = null;

    protected $defaultCollate = null;

    protected $charset = null;

    protected $collate = null;

    protected $comment = [];

    protected $renameColumns = [];

    protected $dropColumns = [];

    protected $nullable = [];

    #array shape: [column => value]
    protected $default = [];

    public function __construct($tableName, $charsetCollate, $tablePrefix)
    {
        $this->tableName = $tableName;
        $this->charsetCollate = $charsetCollate;
        $this->tablePrefix = $tablePrefix;
    }

    public function addColumn($column, $type)
    {
        $this->column = $column;
        $this->columnType = $type;
        $this->columns[$column] = $type;

        return $this;
    }

    /**
     * @return $this
     */
    public function id($name = 'id')
    {
        $this->addColumn($name, 'bigint(20) unsigned AUTO_INCREMENT');
        $this->primaryKey = 'id';
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function string($column, $length = 255)
    {
        $this->addColumn($column, "varchar($length)");
        return $this;
    }

    /**
     * @return $this
     */
    public function index()
    {
        $this->indexKey[] = $this->column;
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function text($column)
    {
        $this->addColumn($column, 'text');
        return $this;
    }

    public function defaultValue($value)
    {
        $this->default[$this->column] = $value;
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function longText($column)
    {
        $this->addColumn($column, "longtext");
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function integer($column, $length = 11)
    {
        $this->addColumn($column, "int($length)");
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function bigInteger($column, $length = 20)
    {
        $this->addColumn($column, "bigint($length)");
        return $this;
    }


    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function unsignedBigInteger($column, $length = 20)
    {
        $this->addColumn($column, "bigint($length) unsigned");
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function tinyInteger($column, $length = 4)
    {
        $this->addColumn($column, "tinyint($length)");
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function mediumInteger($column, $length = 9)
    {
        $this->addColumn($column, "mediumint($length)");
        return $this;
    }

    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function smallInteger($column, $length = 6)
    {
        $this->addColumn($column, "smallint($length)");
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function json($column)
    {
        $this->addColumn($column, 'json');
        return $this;
    }


    /**
     * @param $column
     * @param $length
     * @return $this
     */
    public function unsignedInteger($column, $length = 11)
    {
        $this->addColumn($column, "int($length) unsigned");
        return $this;
    }

    /**
     * @return $this
     */
    public function timestamps()
    {
        $this->addColumn('created_at', 'timestamp DEFAULT CURRENT_TIMESTAMP');
        $this->addColumn('updated_at', 'timestamp DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP');
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function primary($column)
    {
        $this->primaryKey = $column;
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function unique($column)
    {
        $this->uniqueKey[] = $column;
        return $this;
    }

    public function foreign($column)
    {
//        $this->addColumn($column, 'bigint(20) unsigned');
//        $this->foreignKey[] = $column;
//        return $this;
    }

    /**
     * @param $table
     * @return void
     */
    public function reference($table)
    {
//        $this->foreignKey[$this->column] = $table;
//        return $this;
    }

    /**
     * @param $comment
     * @return $this
     */
    public function comment($comment)
    {
        $this->comment[$this->column] = $comment;
        return $this;
    }

    /**
     * @param $table
     * @return void
     */
    public function references($table)
    {
//        $this->foreignKey[$this->column] = $table;
//        return $this;
    }

    public function on($column)
    {
//        $this->foreignKey[$this->column] = $column;
//        return $this;
    }

    public function onDelete($action)
    {

    }

    public function onUpdate($action)
    {

    }

    /**
     * @param $oldColumn
     * @param $newColumn
     * @return $this
     */
    public function renameColumn($oldColumn, $newColumn)
    {
        $this->renameColumns[$oldColumn] = $newColumn;
        return $this;
    }

    /**
     * @param $column
     * @return $this
     */
    public function dropColumn($column)
    {
        $this->dropColumns[] = $column;
        return $this;
    }

    /**
     * @return string
     */
    public function toSql()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->tablePrefix}{$this->tableName} (";

        $sql .= $this->buildColumns();
        $sql .= $this->buildPrimaryKey();
        $sql .= $this->buildUniqueKey();
        $sql .= $this->buildIndexKey();
        $sql .= $this->buildForeignKey();
        $sql .= $this->buildEngine();
        $sql .= $this->buildAutoIncrement();
        $sql .= $this->buildCharset();
        $sql .= $this->buildCollate();
        $sql .= $this->buildComment();
        $sql .= $this->buildRenameColumns();
        $sql .= $this->buildDropColumns();
        $sql = rtrim($sql, ',');

        $sql .= ") {$this->charsetCollate};";

        return $sql;
    }

    /**
     * @return string
     */
    public function buildColumns()
    {
        $columns = '';
        foreach ($this->columns as $column => $type) {

            $columns .= "{$column} {$type}";

            if (in_array($column, $this->nullable)) {
                $columns .= ' NULL,';
            } else if (in_array($column, $this->default)) {
                $columns .= " DEFAULT '{$this->default[$column]}',";
            } else {
                $columns .= ' NOT NULL,';
            }
        }

        return $columns;
    }

    /**
     * @return string
     */
    public function buildPrimaryKey()
    {
        if ($this->primaryKey) {
            return "PRIMARY KEY ({$this->primaryKey}),";
        }
        return '';
    }

    /**
     * @return $this
     */
    public function nullable()
    {
        $this->nullable[] = $this->column;
        return $this;
    }

    /**
     * @return string
     */
    public function buildUniqueKey()
    {
        $uniqueKey = '';
        foreach ($this->uniqueKey as $key) {
            $uniqueKey .= "UNIQUE KEY {$key} ({$key}),";
        }
        return $uniqueKey;
    }

    /**
     * @return string
     */
    public function buildIndexKey()
    {
        $indexKey = '';
        foreach ($this->indexKey as $key) {
            $indexKey .= "KEY {$key} ({$key}),";
        }
        return $indexKey;
    }

    /**
     * @return string
     */
    public function buildForeignKey()
    {
        if ($this->foreignKey) {
            return "FOREIGN KEY ({$this->foreignKey}),";
        }
        return '';
    }

    /**
     * @return string
     */
    public function buildEngine()
    {
        if ($this->engine) {
            return "ENGINE={$this->engine},";
        }
        return '';
    }

    /**
     * @return string
     */
    public function buildAutoIncrement()
    {

        if ($this->autoIncrement) {
            return "AUTO_INCREMENT={$this->autoIncrement},";
        }
        return '';
    }

    /**
     * @return string
     */
    public function buildCharset()
    {
        if ($this->charset) {
            return "CHARSET={$this->charset},";
        }
        return '';
    }

    /**
     * @return string
     */
    public function buildCollate()
    {
        if ($this->collate) {
            return "COLLATE={$this->collate},";
        }
        return '';
    }

    /**
     * @return string
     */
    public function buildComment()
    {
        $comment = '';
        foreach ($this->comment as $column => $value) {
            $comment .= "COMMENT ON COLUMN {$this->tablePrefix}{$this->tableName}.{$column} IS '{$value}',";
        }
        return $comment;
    }

    /**
     * @param $engine
     * @return $this
     */
    public function engine($engine)
    {
        $this->engine = $engine;
        return $this;
    }

    /**
     * @param $autoIncrement
     * @return $this
     */
    public function autoIncrement($autoIncrement)
    {
        if (is_int($autoIncrement)) {
            $this->autoIncrement = $autoIncrement;
        }
        return $this;
    }

    /**
     * @param $charset
     * @return $this
     */
    public function charset($charset)
    {
        $this->charset = $charset;
        return $this;
    }

    /**
     * @param $collate
     * @return $this
     */
    public function collate($collate)
    {
        $this->collate = $collate;
        return $this;
    }


    /**
     * @param $defaultCharset
     * @return $this
     */
    public function defaultCharset($defaultCharset)
    {
        $this->defaultCharset = $defaultCharset;
        return $this;
    }

    /**
     * @param $defaultCollate
     * @return $this
     */
    public function defaultCollate($defaultCollate)
    {
        $this->defaultCollate = $defaultCollate;
        return $this;
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->toSql();
    }

    /**
     * @return string
     */
    public function buildRenameColumns()
    {
        $renameColumns = '';
        foreach ($this->renameColumns as $oldColumn => $newColumn) {
            $renameColumns .= "ALTER TABLE {$this->tablePrefix}{$this->tableName} RENAME COLUMN {$oldColumn} TO {$newColumn};";
        }
        return $renameColumns;
    }

    /**
     * @return string
     */
    public function buildDropColumns()
    {
        $dropColumns = '';
        foreach ($this->dropColumns as $column) {
            $dropColumns .= "ALTER TABLE {$this->tablePrefix}{$this->tableName} DROP COLUMN {$column};";
        }
        return $dropColumns;
    }


}
