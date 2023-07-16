<?php

namespace Repository;
use PDOException;
use PDO;

class SkuExistsException extends PDOException {}
class ProductRepository{
    private $pdo;

    public function __construct($pdo){
        $this->pdo = $pdo;
    }

    public function getAll(){
        return $this->pdo->query('SELECT * FROM products')->fetchAll(PDO::FETCH_ASSOC);
    }

    public function add($sku , $name , $price , $size=null , $weight=null , $dimensions=null ){
        $stmt = $this->pdo->prepare('INSERT INTO products (sku, name, price , size , weight , dimensions) VALUES (?, ?, ?, ?, ?, ?)');
        $stmt->execute([$sku, $name, $price, $size, $weight, $dimensions ]);
    }

    public function deleteBySkus(array $sku){
        $skuList = implode(',', array_fill(0, count($sku), '?'));
        $stmt = $this->pdo->prepare("DELETE FROM products WHERE sku IN ($skuList)");
        $stmt->execute($sku);
    }

    public function checkSkuExists($sku , $exception=false){
        $stmt = $this->pdo->prepare('SELECT * FROM products WHERE sku = ?');
        $result = $stmt->execute([$sku])->fetch(PDO::FETCH_ASSOC);
        if($result && $exception){
            throw new SkuExistsException('This ID already exists');
        }
        return (bool) $result;
    }

}

?>