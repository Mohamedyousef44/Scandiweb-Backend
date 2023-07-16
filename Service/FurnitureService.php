<?php
namespace Service;
use Service\ProductService;

class FurnitureService extends ProductService{

    public function __construct($repository){
        parent::__construct($repository);
    }
    public function addProduct($data){

        $dimensions = $data['height'].'X'.$data['width'].'X'.$data['length'] ;
        $this->repository->add($data['sku'] , $data['name'] , $data['price'] ,null ,null, $dimensions);
    }
}