<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 15:27
 */

namespace App\Models;
use App\DB;

class Model
{
    protected $db;
    protected $tableName = 'catalog';
    public function __construct() {
        $this->db = DB::getDbConnect();
    }
}