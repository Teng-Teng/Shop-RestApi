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
    public function addItem($name, $price, $imageUrl, $description) {
        $conn = new Database();
        $affected_rows = $conn->insertItem($name, $price, $imageUrl, $description);

        return $affected_rows;
    }

    public function deleteItem($id) {
        $conn = new Database();
        $result = $conn->deleteItemById($id);

        return $result;
    }

}




