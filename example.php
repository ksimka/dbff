<?php

require 'vendor/autoload.php';

use \Dbff\Element\Column;
use \Dbff\Element\Type;
use \Dbff\Element\TypeProps\IntProps;
use \Dbff\Element\TypeProps\CharProps;
use \Dbff\Element\Table;
use \Dbff\DbffableCollection as Collection;
use \Dbff\Element\Index;
use \Dbff\Element\Database;
use \Dbff\Parser\TypeParser;
use \Dbff\Parser\IndexParser;
use \Dbff\Parser\ColumnParser;
use \Dbff\Parser\TableParser;
use \Dbff\Builder\TypeBuilder;
use \Dbff\Builder\IndexBuilder;
use \Dbff\Builder\ColumnBuilder;
use \Dbff\Builder\TableBuilder;

$dbffer = new \Dbff\Dbffer();

/*
 * Using dbff structures, filling manually
 */

// Types
$type1 = new Type('int', new IntProps(10, true, false));
$type2 = new Type('int', new IntProps(8, true, true));
$type3 = new Type('text', new CharProps(100, 'utf-8', ''));

showDbff($dbffer->compare($type1, $type2), 'Types');
/*
 *  [
 *      'props' => [            // type props are different
 *          'length' => [       // different length: 1st element has length 10, 2nd — 8
 *              0 => 10,
 *              1 => 8,
 *          ],
 *          'zerofill' => [     // zerofill options: 1st element hasn't zerofill, 2nd has
 *              0 => false,
 *              1 => true,
 *          ],
 *      ],
 *  ]
 */

showDbff($dbffer->compare($type1, $type3), 'Types');
/*
 * [
 *      'name' => [             // type names are different: 1st type is int, 2nd — text
 *          0 => 'int',
 *          1 => 'text',
 *      ],
 * ]
 */

// Columns

$col1 = new Column('id', $type1, true, 0, true);
$col2 = new Column('id2', $type2, true, 100, false);  // Names are not compared

showDbff($dbffer->compare($col1, $col2), 'Columns');
/*
 * [
 *      'type' => [             // types are different...
 *          'props' => [        // ...to be more precise — types props are different...
 *              'length' => [   // ...1st has length 10, 2nd — 8
 *                  0 => 10,
 *                  1 => 8,
 *              ],
 *              'zerofill' => [
 *                  0 => false,
 *                  1 => true,
 *              ],
 *          ],
 *      ],
 *      'default' => [          // default values for these columns are different
 *          0 => 0,             // 1st has default 0
 *          1 => 100,           // 2nd — 100
 *      ],
 *      'isautoinc' => [        // 1st is autoincrement column, 2nd is not
 *          0 => true,
 *          1 => false,
 *      ],
 * ]
 */

// Tables

$index = new Index('', 'primary', ['id'], 'hash');

$table1 = new Table(
    'Post', new Collection([$col1, $col2]), new Collection([]), false, '', 'utf8_general_ci', 'InnoDB', 20
);
$table2 = new Table(
    'Post', new Collection([$col1, $col2]), new Collection([$index]), true, '', 'utf8_general_ci', 'InnoDB', 20
);
// temporary field doesn't compare

showDbff($dbffer->compare($table1, $table2), 'Tables');
/*
 * [
 *      'indices' => [          // indices are different
 *          'length' => [       // 1st table has no indices, 2nd has one
 *              0 => 0,
 *              1 => 1,
 *          ],
 *          'names' => [
 *              0 => [],
 *              1 => [
 *                  0 => ''     // 2nd table has primary key (the only index with empty name)
 *              ],
 *          ],
 *      ],
 * ]
 */

// Databases

$table3 = new Table('Post2', new Collection([$col1]), new Collection([]), true, '', 'utf8_general_ci', 'MyISAM', 0);

$db1 = new Database('db1', new Collection([$table1, $table2]), 'utf8', 'utf8_general_ci');
$db2 = new Database('db2', new Collection([$table1, $table3]), 'utf16', 'utf8_general_ci');

showDbff($dbffer->compare($db1, $db2), 'Databases');
/*
 * [
 *      'tables' => [                       // tables have differences
 *          'length' => [                   // 1st db has 1 table, 2nd — 2
 *              0 => 1,
 *              1 => 2,
 *          ],
 *          'names' => [
 *              0 => [],                    // 1st db misses table `Post2` ...
 *              1 => [                      // ... or 2nd db has extra table `Post2`, depends on your logic
 *                  1 => 'Post2',
 *              ],
 *          ],
 *          'dbff' => [                     // tables diff
 *              'Post' => [                 // tables `Post` are different
 *                  'indices' => [          // and so on ...
 *                      'length' => [
 *                          0 => 1,
 *                          1 => 0,
 *                      ],
 *                      'names' => [
 *                          0 => [
 *                              0 => '',
 *                          ],
 *                          1 => [],
 *                      ],
 *                  ],
 *              ],
 *          ],
 *      ],
 *      'charset' => [
 *          0 => 'utf8',
 *          1 => 'utf16',
 *      ],
 * ]
 */

/*
 * Using parsers
 */

$columnParser = new ColumnParser();
$columnStruct = $columnParser->parse("`id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT");

showDbff($columnStruct, 'Column struct');
/*
 * string is parsed into struct
 *
 * [
 *      'name' => 'id',                     // column's name
 *      'type' => 'INT(10) UNSIGNED',       // type was not parsed because column parser knows nothing about types
 *      'null' => false,                    // can be null? no
 *      'autoinc' => true,                  // is autoincrement? yes
 *      'default' => '',                    // default value — empty string means zero value of column's type
 * ]
 */

$typeParser = new TypeParser();
$typeStruct = $typeParser->parse($columnStruct['type']);

showDbff($typeStruct, 'Type struct');
/*
 * type struct depends on concrete type group
 *
 * [
 *      'group' => 'int',           // one of integer types
 *      'type' => 'int',            // INT type
 *      'length' => 10,             // output length
 *      'unsigned' => false,        // unsigned or not
 *      'zerofill' => true,         // fill with zero values? yes
 * ]
 */

/*
 * Using builders: create elements directly from strings
 */

$builder = new TableBuilder(
    new TableParser(),
    new ColumnBuilder(
        new ColumnParser(),
        new TypeBuilder(new TypeParser())
    ),
    new IndexBuilder(new IndexParser())
);
// or you can use \Dbff\Builder\DefaultBuildersFactory::createTableBuilder();

$table1 = $builder->createFromString(
    "CREATE TABLE `Post` (
        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        `anketa_id` INT(10) UNSIGNED,
        `data` TEXT NOT NULL COLLATE utf8_general_ci,
        `flags` TINYINT(3) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        INDEX `user` (`anketa_id`)
    )
    COLLATE=utf8_unicode_ci
    ENGINE=InnoDB
    AUTO_INCREMENT=51;"
);
$table2 = $builder->createFromString(
    "CREATE TABLE `Post` (
        `id` INT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
        `anketa_id` INT(10) UNSIGNED,
        `data` TEXT NOT NULL COLLATE utf8_unicode_ci,
        `flags` TINYINT(3) NOT NULL DEFAULT '0',
        PRIMARY KEY (`id`),
        INDEX `user` (`anketa_id`)
    )
    COLLATE=utf8_unicode_ci"
);

showDbff($dbffer->compare($table1, $table2), 'Tables');
/*
 * run and look at the results
 */

// look at the DatabaseBuiler::createFromString phpdoc comment to find out string format
$dbBuilder = \Dbff\Builder\DefaultBuildersFactory::createDatabaseBuilder();
$db1 = $dbBuilder->createFromString(
    "create database `database` default character set utf8

    CREATE TABLE `Post` (
        `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
        PRIMARY KEY (`id`),
    )"
);
$db2 = $dbBuilder->createFromDbAndTablesStrings(
    "create database `database` default character set utf8",
    [
        "CREATE TABLE `User` (
            `name` VARCHAR(100),
            PRIMARY KEY (`name`),
        )"
    ]
);
showDbff($dbffer->compare($db1, $db2), 'Databases');

// simple output helper
function showDbff($dbff, $comment = '') {
    if ($comment) {
        echo $comment . "\n";
    }
    var_export($dbff);
    echo "\n\n";
}
