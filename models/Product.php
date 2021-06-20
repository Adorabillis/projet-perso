<?php

namespace Models;

class Product extends Database
{
	public function getAllProducts():array
	{
		return $this -> findAll(
			'SELECT id_product, product_name, stock, price, category_name, description, SUBSTR(description,1,100) AS description100, src_img, alt_img FROM product
			INNER JOIN category ON category.id_category = product.id_category'
			);
	}
	
	public function addProduct($name, $description, $prix, $categorie, $quantite, $src, $alt)
	{
		$this -> query(
			"INSERT INTO product (product_name, description, price, id_category, stock, src_img, alt_img) VALUES (?,?,?,?,?,?,?)",
			[$name, $description, $prix, $categorie, $quantite, $src, $alt]
			);
	}

	public function ModifyProduct($name, $description, $prix, $categorie, $quantite, $src, $alt, $id )
	{
		//requêtes sql qui permet la modification d'une catégorie
		$this -> query("UPDATE product 
		SET product_name = ?, description = ?, price = ?, id_category = ?, stock = ?, src_img = ?, alt_img = ?
		WHERE id_product = ?",[$name, $description, $prix, $categorie, $quantite, $src, $alt, $id]);
	}

	public function getProductById(int $id):array
	{
		return $this -> findOne('
		SELECT id_product, product_name, description, SUBSTR(description,1,100) AS description100, price, product.id_category AS categoryId, stock, src_img, alt_img, category_name AS categoryName
		FROM product 
		INNER JOIN category ON category.id_category = product.id_category
		WHERE id_product = ?',[$id]);
	}

	public function deleteProduct($id)
	{
		//requête sql qui permet la suppression de la catégorie
		$this -> query("DELETE FROM product WHERE id_product = ? ",[$id]);
	}
}