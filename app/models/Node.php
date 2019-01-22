<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 15:25
 */

namespace App\Models;


class Node extends Model
{
    protected $tableName = 'catalog';

    public function add($data) {
        if(!isset($data['date_add']))
            $data['date_add'] = $this->db->now();
        return $this->db->insert($this->tableName, $data);
    }

    public function update($id, $data){
        $this->db->where('id',$id);
        return $this->db->update($this->tableName, $data);
    }

    public function delete($id) {
        $catalog = new Catalog();
        $idx = $catalog->getArray($id);
        $this->db->where('id',$idx, 'in');
        return $this->db->delete($this->tableName);
    }
}