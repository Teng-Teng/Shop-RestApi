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
            $this->connection = new PDO('mysql:host=localhost;dbname=shop_rest;charset=utf8mb4', 'root', 'root',
                [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                //PDO::ATTR_EMULATE_PREPARES   => false,
                ]);
        }
        return $this->connection;
    }

    /**
     * @param $name
     * @param $price
     * @param $imageUrl
     * @param $description
     * @return mixed
     */
    public function insertItem($name, $price, $imageUrl, $description) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "INSERT INTO Item(name, price, image_url, description) VALUES (:name, :price, :imageUrl, :description)";

            $stmt = $conn->prepare($sql);
            $stmt->execute(
                array(
                    ':name' => $name,
                    ':price' => $price,
                    ':imageUrl' => $imageUrl,
                    ':description' => $description
                )
            );
            $conn->commit();

            $affected_rows = $stmt->rowCount();
            return $affected_rows . " record insert successfully. ";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function selectAllItems() {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "SELECT * FROM Item";
            //create a PDO statement object from connection object
            // $pdo object run query function and this function return a statement object
            $stmt = $conn->query($sql);
            $conn->commit();

            //execute the statement and get all the results
//            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $result = $stmt->fetchAll();
            return $result;
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function selectItemById($id) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "SELECT * FROM Item where id = :id";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            $conn->commit();

            $Item = $stmt->fetch();
//            $result = array(
//                'id' => $Item['id'],
//                'name' => $Item['name'],
//                'price' => $Item['price'],
//                'imageUrl' => $Item['image_url'],
//                'description' => $Item['description']
//            );
//            return $result;
            return $Item;
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function updateItem($id, $price) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "UPDATE Item SET price = ? where id = ?";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute([$price, $id]);
            $conn->commit();

            $updated = $stmt->rowCount();
            return $updated." record update successfully.";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }

    public function deleteItemById($id) {
        try {
            $conn = $this->getInstanceConnection();

            $conn->beginTransaction();
            $sql = "DELETE FROM Item WHERE id = :id";
            $stmt = $this->getInstanceConnection()->prepare($sql);
            $stmt->execute(
                array(
                    ':id' => $id
                )
            );
            $conn->commit();

            $affected_rows = $stmt->rowCount();
            return $affected_rows . " record delete successfully.";
        } catch(PDOException $e) {
            $conn->rollback();
            return $sql . "<br>" . $e->getMessage();
        }
    }
}





