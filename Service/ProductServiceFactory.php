<?php

namespace Service;

class ProductServiceFactory {
    public static function create(string $type, $repository) : ProductService {
        switch ($type) {
            case 'book':
                return new BookService($repository);
            case 'dvd':
                return new DvdService($repository);
            case 'furniture':
                return new FurnitureService($repository);
            default:
                throw new \InvalidArgumentException("Invalid product type: $type");
        }
    }
}

?>