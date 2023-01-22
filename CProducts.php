<?php
class CProducts
{
    public static function connect(string $host, string $db, string $user, string $pass) : object
    {
        $attr = "mysql:host=".$host.";dbname=".$db;
        $opts = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => true,
            PDO::MYSQL_ATTR_INIT_COMMAND => "SET sql_mode='STRICT_ALL_TABLES'"
          ];
        $pdo = new PDO($attr, $user, $pass, $opts);
        $pdo->exec("CREATE TABLE IF NOT EXISTS Products(
            ID INTEGER PRIMARY KEY AUTO_INCREMENT,
            PRODUCT_ID varchar(25) NOT NULL,
            PRODUCT_NAME varchar(80) NOT NULL,
            PRODUCT_PRICE FLOAT NOT NULL,
            PRODUCT_ARTICLE TEXT NOT NULL,
            PRODUCT_QUANTITY INTEGER NOT NULL,
            DATE_CREATE TIMESTAMP NOT NULL,
            IS_HIDDEN BOOLEAN DEFAULT 0
            )");
        return $pdo;
    }

    public function getProducts($pdo, $limit = null) : array
    {
        $sql = "SELECT  ID, PRODUCT_ID, PRODUCT_NAME, PRODUCT_PRICE, PRODUCT_ARTICLE, PRODUCT_QUANTITY, DATE_CREATE
            FROM Products
            WHERE IS_HIDDEN = 0
            ORDER BY DATE_CREATE DESC";
        if ($limit != null) {
            $sql.=" LIMIT $limit";
        }
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $result;
    }

    public function setHidden($pdo, $id)
    {
        $sql = "UPDATE Products
                SET IS_HIDDEN = 1
                WHERE ID = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
    public function setQuantity($pdo, $id, $quantity)
    {
        $sql = "UPDATE Products
                SET PRODUCT_QUANTITY = $quantity
                WHERE ID = $id";
        $stmt = $pdo->prepare($sql);
        $stmt->execute();
    }
}