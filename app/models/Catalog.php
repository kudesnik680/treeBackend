<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 14:57
 */

namespace App\Models;


class Catalog extends Model
{
    protected $tableName = 'catalog';

    public function getAll() {
        return $this->db->get($this->tableName);
    }

    public function sorting($sort_fields) {
        foreach ($sort_fields as $k => $v)
        {
            $this->db->orderBy($k,$v);
        }
        return $this;
    }

    public function getTree() {
        $tree = [];
        $this->buildTree($this->getAll(), 0, $tree);
        return $tree;
    }

    private function buildTree($array, $parent_id, &$tree) {
        foreach ($array as $key=>$value) {
            if($value['parent_id'] == $parent_id) {
                $branch = [
                    'id' => $value['id'],
                    'parent_id' => $value['parent_id'],
                    'name' => $value['name'],
                    'date_add' => $value['date_add'],
                    'children' => []
                ];
                $this->buildTree($array, $value['id'], $branch['children']);
                $tree[] = $branch;
            }
        }
    }

    public function getArray($id) {
        $array[] = $id;
        $this->destroyTree($this->getAll(), $id, $array);
        return $array;
    }

    private function destroyTree($array, $parent_id, &$tree) {
        foreach ($array as $key=>$value) {
            if($value['parent_id'] == $parent_id) {
                $tree[] = $value['id'];
                $this->destroyTree($array, $value['id'], $tree);
            }
        }
    }

}