<?php
/**
 * Created by PhpStorm.
 * User: teng
 * Date: 10-Apr-18
 * Time: 04:45 PM
 */

class manage {
    /**
     *
     */
    public function insertItem() {
        $name        = $_POST['ins_name'];
        $price       = $_POST['ins_price'];
        $imageUrl    = $_POST['ins_url'];
        $description = $_POST['ins_desc'];

        $conn = new Database();
        $affected_rows = $conn->insertItem($name, $price, $imageUrl, $description);

        return json_encode($affected_rows);
    }

    public function deleteItem() {
        $id = $_POST['del_id'];
        $conn = new Database();
        $result = $conn->deleteItemById($id);

        return json_encode($result);
    }

}




