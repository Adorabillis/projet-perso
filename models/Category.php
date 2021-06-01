<?php

namespace Models;

class Category extends Database
{

	public function getAllCategory():array
	{
		return $this -> findAll("SELECT id_category, category_name FROM category");	
	}
	
		public function AddCategory($nom)
	{
		//requête sql qui permet l'ajout de la catégorie
		$this -> query("INSERT INTO category(category_name) VALUES (?)",[$nom]);
	}
	
	public function ModifyCategory($name, $id)
	{
		//requêtes sql qui permet la modification d'une catégorie
		$this -> query("UPDATE category 
		SET category_name = ?
		WHERE id_category = ?",[$name, $id]);
	}
	
	public function findCategoryById($id):?array
	{
		return $this -> findOne("SELECT id_category, category_name
		FROM category WHERE id_category = ?",[$id]);
	}
	
	public function deleteCategory($id)
	{
		//requête sql qui permet la suppression de la catégorie
		$this -> query("DELETE FROM category WHERE id_category = ? ",[$id]);
	}
}