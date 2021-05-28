<?php

namespace Controllers;

class GameController 
{	
	public function display()
	{
		//afficher le jeu
        $template = 'views/game.phtml';
        include 'views/layout_front.phtml';
	}
}

