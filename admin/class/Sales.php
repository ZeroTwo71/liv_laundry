<?php
require_once('../database/Database.php');
require_once('../interface/iSales.php');
class Sales extends Database implements iSales
{
	public function new_sales($customer, $type_desc, $laundry_rec, $amount)
	{
		$sql = "INSERT INTO sales(sale_customer_name, sale_type_desc, sale_laundry_received, sale_amount)
			VALUES(?,?,?,?)";
		return $this->insertRow($sql, [$customer, $type_desc, $laundry_rec, $amount]);
	}

	public function daily_sales($date)
	{
		$sql = "SELECT *
				FROM sales
				WHERE DATE(`sale_date_paid`) = ?
				ORDER BY sale_date_paid DESC";
		return $this->getRows($sql, [$date]);
	}
}
$sales = new Sales();
