<?php
/**
 * Created by PhpStorm.
 * User: teng
 * Date: 10-Apr-18
 * Time: 05:01 PM
 */

class Database {
    private $connection;

    private function getInstanceConnection() {
        if (!$this->connection) {
            $this->connection = new PDO('mysql:host=localhost;dbname=shop_rest;charset=utf8mb4', 'root', 'root');
        }
        return $this->connection;
    }

    public function getAllItems() {
        $this->getInstanceConnection();

        $sql = "SELECT * FROM Item";

        //create a PDO statement object from connection object
        // $pdo object run query function and this function return a statement object
        $stmt = $this->connection->query($sql);

        //execute the statement and get all the results
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $result;
    }

    /**
     * @param $name
     * @param $price
     * @param $imageUrl
     * @param $description
     * @return mixed
     */
    public function insertItem($name, $price, $imageUrl, $description) {
        $this->getInstanceConnection();
        $sql = "INSERT INTO Item(name, price, image_url, description) VALUES (:name, :price, :imageUrl, :description)";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute(
            array(
                ':name' => $name,
                ':price' => $price,
                ':imageUrl' => $imageUrl,
                ':description' => $description
            )
        );

        $affected_rows = $stmt->rowCount();

        return $affected_rows;
    }

    public function getItemById($id) {
        $sql = "SELECT * FROM Item where id = :id";

        $stmt = $this->getInstanceConnection()->prepare($sql);

        $stmt->execute(
            array(
                ':id' => $id
            )
        );

        $Item = $stmt->fetch();

        $result = array(
            'id' => $Item['id'],
            'name' => $Item['name'],
            'price' => $Item['price'],
            'imageUrl' => $Item['image_url'],
            'description' => $Item['description']
        );

        return $result;
    }

    public function updateItem($id, $price) {
        $this->getInstanceConnection();
        $sql = "UPDATE Item SET price = ? where id = ?";

        $stmt = $this->connection->prepare($sql);
        $stmt->execute([$price, $id]);

        $updated = $stmt->rowCount();
        return $updated." record updated successfully. ";
    }

    public function deleteItemById($id) {
        $sql = "DELETE FROM Item WHERE id = :id";

        $stmt = $this->getInstanceConnection()->prepare($sql);

        $stmt->execute(
            array(
                ':id' => $id
            )
        );

        $affected_rows = $stmt->rowCount();

        return $affected_rows;
    }

}





