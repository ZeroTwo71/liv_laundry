<?php
require_once('../class/Laundry.php');
if (isset($_POST['type']) && isset($_POST['price'])) {
	$type = $_POST['type'];
	$price = $_POST['price'];
	$price = ($price);
	$type = strtolower($type);
	$type = ucwords($type);

	$saveType = $laundry->insert_laundry($type, $price);
	$return['valid'] = false;
	if ($saveType) {
		$return['valid'] = true;
		$return['msg'] = 'Save Successfully!';
	}
	echo json_encode($return);
}

$laundry->Disconnect();
