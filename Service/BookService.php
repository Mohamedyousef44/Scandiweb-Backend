<?php
namespace Service;
use Service\ProductService;


class BookService extends ProductService{

    public function __construct($repository){
        parent::__construct($repository);
    }

    public function addProduct($data){
        $this->repository->add($data['sku'] , $data['name'] , $data['price'] ,null ,$data['weight'] , null);
    }

}