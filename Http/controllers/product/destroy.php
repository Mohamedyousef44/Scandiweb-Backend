<?php 

use Core\Database;
use Repository\ProductRepository;
use Service\BookService;
use Core\Response;


try {
    
    $db = new Database(__HOST__, __DB__, __USER__, __PASS__ );
    $pdo = $db->connect();
    $repository = new ProductRepository($pdo);
    $service = new BookService($repository);

    $json = file_get_contents('php://input');
    $ids = json_decode($json, true);
    $service->deleteProducts($ids);

    header(Response::CONTENT_TYPE);
    echo json_encode(['message' => 'Products deleted successfully']);
    
} catch (PDOException $e) {

    http_response_code(Response::INTERNAL_ERROR);
    echo json_encode(['message' => $e->getMessage()]);

} catch (RuntimeException $e) {

    http_response_code(Response::BAD_REQUEST);
    echo json_encode(['message' => $e->getMessage()]);

} finally {

    $db->close();
}