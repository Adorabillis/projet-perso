<?php

namespace Controllers;

class CartController {
    
    public function addCart()
    {
        
             if(isset($_GET["action"]))  
         {  
              if($_GET["action"] == "delete")  
              {  
                   foreach($_SESSION["shopping_cart"] as $keys => $values)  
                   {  
                        if($values["item_id"] == $_GET['id'])  
                        {  
                             unset($_SESSION["shopping_cart"][$keys]);  
                             
                            header('location:index.php?page=cart');
                            
                            exit;
                             
                        }  
                   }  
              }  
         } 
        
        $data = json_decode(file_get_contents('php://input'));
        
          if(isset($_SESSION["shopping_cart"]))  
          {  
               $item_array_id = array_column($_SESSION["shopping_cart"], "item_id");  
               if(!in_array($data -> id, $item_array_id))  
               {  
                    $count = count($_SESSION["shopping_cart"]);  
                    $item_array = array(  
                         'item_id' => $data -> id,  
                         'item_name' => $data -> Nom,  
                         'item_price' => $data -> prix,  
                         'item_quantity' => $data -> quantite 
                    );  
                    $_SESSION["shopping_cart"][$count] = $item_array;  
               }  
              
          }  
          else  
          {  
               $item_array = array(  
                    'item_id' => $data -> id,  
                    'item_name' => $data -> Nom,  
                    'item_price' => $data -> prix,  
                    'item_quantity' => $data -> quantite  
               );  
               $_SESSION["shopping_cart"][0] = $item_array;  
          }  
          
     
    }
    
    public function displayCart()
    {
        $template = 'views/shop/cart.phtml';
        include 'views/layout.phtml';
    }
} 