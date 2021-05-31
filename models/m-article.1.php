<?php


//fonctions


function getNewArticles()
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		'SELECT id_article, nom_categorie, titre,SUBSTR(description,1,100) AS description100, prenom_auteur, nom_auteur, DATE_FORMAT(date, "%W %e %M %Y") AS newDate FROM articles 
		INNER JOIN categorie ON categorie.id_categorie = articles.id_categorie
		INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur 
		ORDER BY date DESC LIMIT 4'
	);
	
	$query -> execute();
	
	$articles= $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articles;
}

function getAllArticles()
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		'SELECT id_article, nom_categorie, titre,SUBSTR(description,1,100) AS description100, prenom_auteur, nom_auteur, DATE_FORMAT(date, "%W %e %M %Y") AS newDate FROM articles 
		INNER JOIN categorie ON categorie.id_categorie = articles.id_categorie
		INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur 
		ORDER BY date DESC'
	);
	
	$query -> execute();
	
	$articles= $query -> fetchAll(PDO::FETCH_ASSOC);
	
	return $articles;
}

function getArticleById($id_article)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		'SELECT id_article, categorie.id_categorie, nom_categorie, titre, description, auteurs.id_auteur, prenom_auteur, nom_auteur, DATE_FORMAT(date, "%W %e %M %Y") AS newDate FROM articles 
		INNER JOIN categorie ON categorie.id_categorie = articles.id_categorie
		INNER JOIN auteurs ON auteurs.id_auteur = articles.id_auteur 
		WHERE id_article = ?'
	);
	
	$query -> execute([$id_article]);
	
	$article = $query -> fetch(PDO::FETCH_ASSOC);
	
	return $article;
}

//insertion d'un nouvel article dans la BDD grâce au formulaire
function insertArticle($categorie, $auteur, $titre, $texte)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		"INSERT INTO articles (id_categorie, id_auteur, titre, description, date) VALUES(?,?,?,?,NOW())"
	);
		
	$query -> execute([$categorie, $auteur, $titre, $texte]);
}

function deleteArticle($id_article)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		"DELETE FROM articles 
		WHERE id_article = ?"
	);
		
	$query -> execute([$id_article]);
}

function modifyArticle($id, $categorie, $auteur, $titre, $texte)
{
	include 'app/bdd.php';
	
	$query = $bdd -> prepare
	(
		"UPDATE articles 
		SET id_categorie = ?, id_auteur = ?, titre = ?, description = ?
		WHERE id_article = ?"
	);
		
	$query -> execute([$categorie, $auteur, $titre, $texte, $id]);
}
