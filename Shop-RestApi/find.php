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
    public function getItem() {
        $conn = new Database();
        $result = $conn->getAllItems();

        return $result;
    }

    /**
     * @param $id
     */
    public function findItem($id) {
        $conn = new Database();
        $result = $conn->getItemById($id);

//        echo '<pre>';
//        print_r($result);
//        echo '</pre>';

        return $result;
    }

    public function updateItem($id, $price) {
        $conn = new Database();
        $result = $conn->updateItem($id, $price);

        echo '<pre>';
        print_r($result);
        echo '</pre>';

        return $result;

    }


}




