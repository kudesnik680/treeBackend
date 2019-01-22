<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 14:26
 */

namespace App;

class DB
{
    private static $db;

    public static function init() {
        self::$db = new \MysqliDb('localhost', 'root', '', '1bit');

    }

    public static function getDbConnect(){
        return self::$db;
    }

}