<?php

namespace Models;

class Author extends Database
{

	public function getAllAuthors():array
	{
		return $this -> findAll("SELECT id_author, first_name, last_name FROM author");	
	}
	
		public function AddAuthor($prenom, $nom)
	{
		//requête sql qui permet l'ajout de la catégorie
		$this -> query("INSERT INTO author (first_name, last_name) VALUES (?,?)",[$prenom, $nom]);
	}
	
	public function ModifyAuthor($prenom, $nom, $id)
	{
		//requêtes sql qui permet la modification d'une catégorie
		$this -> query("UPDATE author 
		SET first_name = ?, last_name = ?
		WHERE id_author = ?",[$prenom, $nom, $id]);
	}
	
	public function findAuthorById($id):?array
	{
		return $this -> findOne("SELECT id_author, first_name, last_name
		FROM author WHERE id_author = ?",[$id]);
	}
	
	public function deleteAuthor($id)
	{
		//requête sql qui permet la suppression de la catégorie
		$this -> query("DELETE FROM author WHERE id_author = ? ",[$id]);
	}
}