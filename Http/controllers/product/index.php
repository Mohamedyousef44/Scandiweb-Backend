<?php

use Core\Database;
use Core\Response;
use Repository\ProductRepository;
use Service\BookService;




try {
    
    $db = new Database(__HOST__, __DB__, __USER__, __PASS__ );
    $pdo = $db->connect();
    $repository = new ProductRepository($pdo);
    $service = new BookService($repository);

    $result = $service->getAllProducts();

    if (empty($result)) {
        throw new RuntimeException('No Products Found');
    }

    header(Response::CONTENT_TYPE);
    echo json_encode($result);

} catch (PDOException $e) {

    header(Response::CONTENT_TYPE);
    http_response_code(Response::INTERNAL_ERROR);
    echo json_encode(['message' => $e->getMessage()]);

} catch (RuntimeException $e) {

    header(Response::CONTENT_TYPE);
    http_response_code(Response::NOT_FOUND);
    echo json_encode(['message' => $e->getMessage()]);

} finally {

    $db->close();
}
?>