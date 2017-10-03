<?php 

/*
$i = integer
$s = chaine
$m = mixed
$a = array
$o = objet
$s = liste

addition : +
modulo de la division (reste) :  %
*/

$iMaVariable = 0; //int donc var commence par i
$sMonAutreVariable = "Hello $iMaVariable world!/"; //string, deux guillemets = variable interprété, mal car on peut mettre du int dans une chaine
$sEncoreUneAutreVariable = 'Hello $iMaVariable les gens'; //string, deux cotes = variable non interpétré, avec les ' on doit échappé avec \

//Concaténé, meilleur facons
$sMaPhrase = 'Coucou';$sEncoreUneAutreVariable." Bonjourno";
//ou
$sMaPhrase.= " Hello";


$iMaVariable = $iMaVariable +1;
// ou
$iMaVariable += 1;


//Pour le debug,  \n pour saut de ligne en linux
echo "Coucou\n";

var_dump($sMaPhrase); 


require_once("MonObjet.class.php"); // charquait autrefois en mémoire sans executer, le plus utilisé
include_once("MonObjet.class.php"); // Execute, un peu comme un copier coller

$sMaVariableStupide = 0;
$sMaDeuxiemeVariableStupide = 0;

MonObjet::maMethodeStatique(); // Appel d'une fonction statique, pas besoin d'instancier avant, on fait directement appel a la class donc deux ::

$oMonObjet = new MonObjet($sMaVariableStupide,$sMaDeuxiemeVariableStupide); // CONSTRUCT
$oMonObjet->maFonctionPublique(); // METHOD public


