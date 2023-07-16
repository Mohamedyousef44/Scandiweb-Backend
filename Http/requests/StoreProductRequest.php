<?php

namespace Http\Requests;
use Core\Validator;

class StoreProductRequest {

    private $data;

    public function __construct($data){
        $this->data = $data;
    }

    private function issetInputs($input){
        if(!isset($this->data[$input])) {
            throw new \InvalidArgumentException($input . ' is required.');
        }
    }

    public function validateSku(){
        $this->issetInputs('sku');
        Validator::validateString($this->data['sku'] , 'Product ID', true);
    }
    public function validateName(){
        $this->issetInputs('name');
        Validator::validateString($this->data['name'] ,'Product Name', true);
    }
    public function validatePrice(){
        $this->issetInputs('price');
        Validator::validateFloat($this->data['price'] ,'Product Price', true);
    }
    public function validateProductType(){
        $this->issetInputs('productType');
        Validator::validateString($this->data['productType'] ,'Product Type', true);
    }

    public function validateAll(){
        $this->validateSku();
        $this->validateName();
        $this->validatePrice();
        $this->validateProductType();
    }
}