<?php


namespace Service;

abstract class ProductService{
    protected $repository;

    public function __construct($repository){
        $this->repository = $repository;
    }

    public  function getAllProducts(){
        return $this->repository->getAll();
    }

    abstract public function addProduct($data);

    public function deleteProducts(array $sku){
        return $this->repository->deleteBySkus($sku);
    }

}

?>