<?php

namespace Models;

class Order extends Database
{
	
	public function getAllOrder():array
	{
		return $this -> findAll(
			'SELECT orders.id_order, order_date, shipped_date, id_user, id_product, quantity, price FROM orders
			INNER JOIN orderdetails ON orderdetails.id_order = orders.id_order
			ORDER BY order_date DESC'
			);
	}
	
	public function addOrder($idOrder, $status, $user)
	{
		$this -> query(
			"INSERT INTO orders (id_order, order_date, shipped_date, id_user) VALUES (?,NOW(),?,?)",
			[$idOrder, $status, $user]
			);
	}

	public function ModifyOrder($categorie, $title, $description, $src, $alt, $author, $id )
	{
		//requêtes sql qui permet la modification d'une catégorie
		$this -> query("UPDATE blog 
		SET id_categorie = ?, titre = ?, content = ?, src_img = ?, alt_img = ?, id_auteur = ?
		WHERE id_article = ?",[$categorie, $title, $description, $src, $alt, $author, $id]);
	}

	public function getOrderById(int $id):array
	{
		return $this -> findOne('
		SELECT  orders.id_order, order_date, shipped_date, id_user, id_product, quantity, price
		FROM orders 
		INNER JOIN orderdetails ON orderdetails.id_order = orders.id_order
		WHERE id_article = ?',[$id]);
	}

	public function deleteOrder($id)
	{
		//requête sql qui permet la suppression de la catégorie
		$this -> query("DELETE FROM orders WHERE id_order = ? ",[$id]);
	}
}