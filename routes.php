<?php

$router->get('/' , 'product/index.php');
$router->post('/add-product' , 'product/store.php');
$router->delete('/' , 'product/destroy.php');

?>