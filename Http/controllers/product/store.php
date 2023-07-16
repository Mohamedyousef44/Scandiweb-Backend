<?php

use Core\Database;
use Core\Response;
use Repository\ProductRepository;
use Service\ProductServiceFactory;
use Http\Requests\StoreProductRequest;

class SkuExistsException extends PDOException {}

header('Access-Control-Allow-Origin: http://localhost:3000');
header('Access-Control-Allow-Methods: POST');
header('Access-Control-Allow-Headers: Content-Type');
try {
    
    $db = new Database(__HOST__, __DB__, __USER__, __PASS__ );
    $pdo = $db->connect();
    $repository = new ProductRepository($pdo);

    $json = file_get_contents('php://input');
    $data = json_decode($json, true);

    $validation = new StoreProductRequest($data);
    $validation->validateAll();

    $product = ProductServiceFactory::create(strtolower($data['productType']) , $repository);
    $product->addProduct($data);

    header(Response::CONTENT_TYPE);
    echo json_encode(['message' => 'Product added successfully']);
    
} catch (PDOException $e) {

    header(Response::CONTENT_TYPE);
    http_response_code(Response::INTERNAL_ERROR);
    echo json_encode(['message' => $e->getMessage()]);

} catch (InvalidArgumentException | SkuExistsException $e) {

    header(Response::CONTENT_TYPE);
    http_response_code(Response::BAD_REQUEST);
    echo json_encode(['message' => $e->getMessage()]);

} finally {
    $db->close();
}