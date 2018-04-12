<?php
/**
 * Created by PhpStorm.
 * User: teng
 * Date: 10-Apr-18
 * Time: 04:44 PM
 */

class find {
    /**
     *
     */
    public function selectAllItem() {
        $conn = new Database();
        $result = $conn->selectAllItems();

        return json_encode($result);
    }

    /**
     * @param $id
     */
    public function selectItem() {
        $id = $_POST['sel_id'];
        $conn = new Database();
        $result = $conn->selectItemById($id);

        return json_encode($result);
    }

    public function updateItem($id, $price) {
        $conn = new Database();
        $result = $conn->updateItem($id, $price);

        return $result;
    }


}




