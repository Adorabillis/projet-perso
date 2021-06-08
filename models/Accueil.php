<?php

namespace Models;

class Accueil extends Database
{
    	public function modifyContent($name, $description, $src, $alt, $id)
	{
		//requêtes sql qui permet l'ajout de la catégorie
		$this -> query("UPDATE content SET name = ?, content = ?, src_img = ?, alt_img = ?
			WHERE id = ?",[$name, $description, $src, $alt, $id]);
	}
		public function findAllContent()
	{
		return $this -> findAll(
			'SELECT id, name, content, src_img, alt_img FROM content'
			);
	}
	public function getContentById(int $id):array
	{
		return $this -> findOne("
		SELECT id, name, content, src_img, alt_img
		FROM content 
		WHERE id = ?",[$id]);
	}
	
}