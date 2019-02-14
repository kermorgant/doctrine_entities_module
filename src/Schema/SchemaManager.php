<?php

namespace DoctrineEntitiesModule\Schema;

class SchemaManager
{
    const RESOURCE_TABLE = 'module_doctrineentitiesmodule_resource';

    public static function create()
    {
        $sql = [];

        $sql[] = strtr(
            'CREATE TABLE $table (id INT AUTO_INCREMENT NOT NULL,
                         name VARCHAR(255) NOT NULL,
                         UNIQUE INDEX UNIQ_65203CC55E237E06 (name),
                         PRIMARY KEY(id)) DEFAULT CHARSET utf8 ENGINE = $engine;',
            [
                '$table' => _DB_PREFIX_.self::RESOURCE_TABLE,
                '$engine' => _MYSQL_ENGINE_,
            ]
        );

        foreach ($sql as $query) {
            if (\Db::getInstance()->execute($query) == false) {
                throw new \Exception('error with query '.implode(';', $sql));
            }
        }

        return true;
    }

    public static function uninstall()
    {
        $sql = [];

        $sql[] = 'DROP TABLE IF EXISTS '._DB_PREFIX_.self::RESOURCE_TABLE;

        foreach ($sql as $query) {
            if (\Db::getInstance()->execute($query) == false) {
                throw new \Exception('error with query '.$query);
            }
        }
    }
}
