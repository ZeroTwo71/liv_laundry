<?php
require_once('../database/Database.php');
require_once('../interface/iLaundry.php');

class Laundry extends Database implements iLaundry
{
	private function generateResi()
	{
		return strtoupper(bin2hex(random_bytes(4)));
	}

	public function insert_laundry($type, $price)
	{
		$sql = "INSERT INTO laundry_type (laun_type_desc, laun_type_price)
                VALUES(?,?)";
		return $this->insertRow($sql, [$type, $price]);
	}

	public function get_all_laundry()
	{
		$sql = "SELECT *
	            FROM laundry_type
	            ORDER BY laun_type_desc ASC";
		return $this->getRows($sql);
	}

	public function get_type($type_id)
	{
		$sql = "SELECT * 
                FROM laundry_type
                WHERE laun_type_id = ?";
		return $this->getRow($sql, [$type_id]);
	}

	public function edit_type($type_id, $type, $price)
	{
		$sql = "UPDATE laundry_type
                SET laun_type_desc = ?, laun_type_price = ?
                WHERE laun_type_id = ?";
		return $this->updateRow($sql, [$type, $price, $type_id]);
	}

	public function get_status($status_id)
	{
		$sql = "SELECT * 
                FROM laundry_status
                WHERE laun_status_id = ?";
		return $this->getRow($sql, [$status_id]);
	}

	public function edit_status($status_id, $status)
	{
		$sql = "UPDATE laundry_status
                SET laun_stutus_desc = ?,
                WHERE laun_status_id = ?";
		return $this->updateRow($sql, [$status, $status_id]);
	}

	public function all_laundry()
	{
		$claimed = 0;
		$sql = "SELECT l.*, lt.laun_type_desc, lt.laun_type_price, ls.laun_status_desc
            FROM laundry l
            INNER JOIN laundry_type lt ON l.laun_type_id = lt.laun_type_id
            INNER JOIN laundry_status ls ON l.laun_status_id = ls.laun_status_id
            WHERE l.laun_claimed = ?
            ORDER BY l.customer_name ASC";
		return $this->getRows($sql, [$claimed]);
	}


	public function new_laundry($customer, $priority, $weight, $type, $status)
	{
		$resi = $this->generateResi();
		$sql = "INSERT INTO laundry (customer_name, laun_priority, laun_weight, laun_type_id, resi, laun_status_id)
                VALUES(?,?,?,?,?,?)";
		return $this->insertRow($sql, [$customer, $priority, $weight, $type, $resi, $status]);
	}

	public function delete_laundry($laun_id)
	{
		$sql = "DELETE FROM laundry
                WHERE laun_id = ?";
		return $this->deleteRow($sql, [$laun_id]);
	}

	public function get_laundry($laun_id)
	{
		$sql = "SELECT *
                FROM laundry
                WHERE laun_id = ?";
		return $this->getRow($sql, [$laun_id]);
	}

	public function edit_laundry($laun_id, $customer, $priority, $weight, $type, $status)
	{
		$sql = "UPDATE laundry 
            SET customer_name = ?, laun_priority = ?, laun_weight = ?, laun_type_id = ?, laun_status_id = ?
            WHERE laun_id = ?";
		return $this->updateRow($sql, [$customer, $priority, $weight, $type, $status, $laun_id]);
	}

	public function get_laundry2($laun_id)
	{
		$sql = "SELECT *
                FROM laundry l 
                INNER JOIN laundry_type lt 
                ON l.laun_type_id = lt.laun_type_id
                WHERE l.laun_id = ?";
		return $this->getRow($sql, [$laun_id]);
	}

	public function claim_laundry($laun_id)
	{
		$claimed = 1;
		$sql = "UPDATE laundry 
                SET laun_claimed = ?
                WHERE laun_id = ?";
		return $this->updateRow($sql, [$claimed, $laun_id]);
	}
}

$laundry = new Laundry();
