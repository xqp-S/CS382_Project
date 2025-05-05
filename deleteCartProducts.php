<?php
header('Content-Type: application/json');
include 'handleCart.php';

$ch = new HandleCartProducts();
$result = $ch->deleteAllProducts();


if ($result) {
    echo json_encode(['success' => true, 'message' => 'All products removed from cart']);
} else {
    echo json_encode(['success' => false, 'message' => 'Failed to clear cart']);
}


$ch->conn->close();
?>