<?php

namespace Models;

class Order extends Database
{

	function getNewArticles()
	{
		return $this -> findAll(
			'SELECT id_article, titre, SUBSTR(content,1,100) AS content100, category_name, first_name, last_name, DATE_FORMAT(date, "%W %e %M %Y") AS newDate FROM blog
			INNER JOIN category ON category.id_category = blog.id_categorie
			INNER JOIN author ON author.id_author = blog.id_auteur
			ORDER BY date DESC LIMIT 4'
			);
	}
	
	public function getAllArticles():array
	{
		return $this -> findAll(
			'SELECT id_article, titre, content, category_name, first_name, last_name, DATE_FORMAT(date, "%W %e %M %Y") AS newDate, src_img, alt_img FROM blog
			INNER JOIN category ON category.id_category = blog.id_categorie
			INNER JOIN author ON author.id_author = blog.id_auteur
			ORDER BY date DESC'
			);
	}
	
	public function addArticle($categorie, $title, $description, $src, $alt, $author)
	{
		$this -> query(
			"INSERT INTO blog (id_categorie, titre, content, src_img, alt_img, id_auteur, date) VALUES (?,?,?,?,?,?,NOW())",
			[$categorie, $title, $description, $src, $alt, $author]
			);
	}

	public function ModifyArticle($categorie, $title, $description, $src, $alt, $author, $id )
	{
		//requêtes sql qui permet la modification d'une catégorie
		$this -> query("UPDATE blog 
		SET id_categorie = ?, titre = ?, content = ?, src_img = ?, alt_img = ?, id_auteur = ?
		WHERE id_article = ?",[$categorie, $title, $description, $src, $alt, $author, $id]);
	}

	public function getArticleById(int $id):array
	{
		return $this -> findOne('
		SELECT id_article, titre, content, src_img, alt_img, id_category, category_name AS categoryName, id_author, first_name, last_name, DATE_FORMAT(date, "%W %e %M %Y") AS newDate
		FROM blog 
		INNER JOIN category ON category.id_category = blog.id_categorie
		INNER JOIN author ON author.id_author = blog.id_auteur
		WHERE id_article = ?',[$id]);
	}

	public function deleteArticle($id)
	{
		//requête sql qui permet la suppression de la catégorie
		$this -> query("DELETE FROM blog WHERE id_article = ? ",[$id]);
	}
}