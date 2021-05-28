<?php

namespace Models;

class Jeux extends Database
{
	//les méthodes qui effectuent des requêtes SQL sur la table JEUX
	public function getAllGames():array
	{
	
		return $this -> findAll("SELECT id,nom_jeu, prix FROM jeux ORDER BY nom_jeu");
		
		
	}

	public function getGameById(int $id):array
	{
	
		return $this -> findOne("SELECT age, id ,nom_jeu, prix, date_sortie, description FROM jeux WHERE id = ?",[$id]);
	}
}