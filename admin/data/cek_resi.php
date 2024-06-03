<?php
require_once('../database/Database.php');
require_once('../class/Laundry.php');
$db = new Database();

header('Content-Type: application/json'); // Menentukan tipe konten sebagai JSON

if (isset($_GET['resi'])) {
    $resi = $_GET['resi'];
    $sql = "SELECT ls.laun_status_desc 
            FROM laundry l 
            INNER JOIN laundry_status ls ON l.laun_status_id = ls.laun_status_id 
            WHERE l.resi = ?";
    $result = $db->getRow($sql, [$resi]);

    if ($result) {
        $response = ['success' => true, 'laun_status_desc' => $result['laun_status_desc']];
    } else {
        $response = ['success' => false];
    }
    $db->Disconnect();
    echo json_encode($response);
} else {
    echo json_encode(['success' => false]);
}
