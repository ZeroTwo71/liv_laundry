<?php
interface iLaundry
{
	public function insert_laundry($type, $price);
	public function get_all_laundry();
	public function get_type($type_id);
	public function edit_type($type_id, $type, $price);
	public function get_status($status_id);
	public function edit_status($status_id, $status);
	public function all_laundry();
	public function new_laundry($customer, $priority, $weight, $type, $status);
	public function delete_laundry($laun_id);
	public function get_laundry($laun_id);
	public function edit_laundry($laun_id, $customer, $priority, $weight, $type, $status);
	public function get_laundry2($laun_id);
	public function claim_laundry($laun_id);
}
