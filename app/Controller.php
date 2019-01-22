<?php
/**
 * Created by PhpStorm.
 * User: kudesnik680
 * Date: 21.01.2019
 * Time: 14:17
 */

namespace App;


use App\Models\Catalog;
use App\Models\Element;
use App\Models\Node;
use Zend\Json\Json;

class Controller
{
    public function index(){
        $catalog = new Catalog();
        $this->response($catalog->getTree());
    }

    public function addNode(){
        $node = new Node();
        $data = [
            'name' => $_POST['name'],
            'parent_id' => $_POST['parent_id']
        ];
        $this->response($node->add($data));
    }

    public function deleteNode($id){
        $node = new Node();
        $this->response($node->delete($id));
    }

    public function updateNode($id){
        $node = new Node();
        $data = ['name' => $_POST['name']];
        $this->response($node->update($id, $data));
    }

    public function sortNode() {
        if(isset($_GET['date'])) {
            $data = ['date_add' => $_GET['date']];
        }
        if(isset($_GET['name'])) {
            $data = ['name' => $_GET['name']];
        }
        $catalog = new Catalog();
        $this->response($catalog->sorting($data)->getTree());
    }

    private function response($data, $status=200) {
        header('HTTP/1.1 200 OK');
        echo json_encode([
            'data' => $data,
            'status' => $status
        ]);
    }

}