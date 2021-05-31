<?php

namespace Models;

class Article extends Database
{

	function getNewArticles()
	{
		return $this -> findAll(
			'SELECT id_article, titre, SUBSTR(content,1,100) AS content100, category_name, first_name, last_name, DATE_FORMAT(date, "%W %e %M %Y") AS newDate FROM blog
			INNER JOIN category ON category.id_category = blog.id_categorie
			INNER JOIN author ON author.id_author = blog.id_auteur
			ORDER BY date DESC LIMIT 3'
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
	
	public function addArticle($category, $title, $content, $src, $alt, $author)
	{
		$this -> query(
			"INSERT INTO blog (id_categorie, titre, content, src_img, alt_img, id_auteur, date) VALUES (?,?,?,?,?,?,NOW()",
			[$category, $title, $content, $src, $alt, $author]
			);
	}

	public function getArticleById(int $id):array
	{
		return $this -> findOne("
		SELECT meal.id, meal.name, src, alt, id_category, category.name AS categoryName 
		FROM meal 
		INNER JOIN category ON category.id = meal.id_category
		WHERE meal.id = ?",[$id]);
	}
}