<?php 
require_once("donjon.class.php");
require_once("personnage.class.php");
require('flight/Flight.php');


Flight::route('/', function(){
    echo 'hello world!';
});


// créer une nouvelle route
Flight::route('/ping', function(){
    echo "pong";
});

Flight::route('GET /donjons', function(){
    // $oMyDonjon = new Donjon(1);

    // $oMyDonjon->setNomDonjon('Mon premier donjon');

    // $sNomDonjon = $oMyDonjon->getNomDonjon();
    
    // echo $sNomDonjon."<br>";

    $sListeDonjons = Donjon::all();

    foreach($sListeDonjons as $oDonjon){
        echo $oDonjon->getNomDonjon();
    }

});


Flight::route('GET /personnages', function(){
    $sPersonnages = Personnage::all();
    
        foreach($sPersonnages as $oPersonnage){
            echo $oPersonnage->getNomPersonnage();
        }

});
Flight::route('POST /personnage', function(){
    $sNomPersonnage = Flight::request()->data->nom_personnage;
    $iPddPersonnage = Flight::request()->data->pdd_personnage;

    // vérifier l'existence de l'objet
    if(!isset($sNomPersonnage)) Flight::halt(406, "Il manque le nom du personnage");

    // Instancier l'objet
    $oPersonnage = Personnage::creer($sNomPersonnage, $iPddPersonnage);

    Flight::json(
        array(
            "id_personnage" =>
                $oPersonnage->getIdPersonnage()
        )
    );
    

    
});




Flight::start();








//  ---------------  Voiture  -----------------
// déclaration var
// $iMoteur = 200; 
// $iNbPassagers = 5;
// $sActionVoiture = "Avancer";

// //appel objet voiture
// $oMaVoiture = new Voiture($iMoteur, $iNbPassagers, $sActionVoiture);

// $sMaNouvelleAction = "Freiner";
// $oMaVoiture->SetActionVoiture($sMaNouvelleAction);

// $sActionEnCour = $oMaVoiture->GetActionVoiture();

//  var_dump($sActionEnCour);

