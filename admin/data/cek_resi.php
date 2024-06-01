<?php
require_once('../database/Database.php');
require_once('../class/Laundry.php');
$db = new Database();

header('Content-Type: application/json'); // Menentukan tipe konten sebagai JSON

if (isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    $sql = "SELECT status FROM laundry WHERE resi = ?";
    $result = $db->getRow($sql, [$resi]);

    if ($result) {
        $response = ['success' => true, 'status' => $result['status']];
    } else {
        $response = ['success' => false];
    }
    $db->Disconnect();
    echo json_encode($response);
} else {
    echo json_encode(['success' => false]);
}
