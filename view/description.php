<?php    
session_start();
ob_start();

if(!isset($_SESSION['descFilms'])||empty($_SESSION['descFilms'])){
    echo    
    "<div>
        <p >Aucun film en session...</p>
    </div>";

}else{
    foreach($_SESSION['descFilms'] as $films){
        var_dump($films);

        foreach($films as $film){
            
        }
    }
}

$contenu = ob_get_clean();
require "template.php";