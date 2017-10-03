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
    $sListeDonjons = Donjon::all();

    // foreach($sListeDonjons as $oDonjon){
    //     Flight::json(
    //         array(
    //             "id_donjon" => $oDonjon->getIdDonjon(),
    //             "nom_donjon" => $oDonjon->getNomDonjon()
    //         )
    //     );
    // }
});

Flight::route('PUT /donjon/@nom_donjon', function($sNomDonjon){
    
        // vérifier l'existence de l'objet
        if(!isset($sNomDonjon)) Flight::halt(406, "Il manque le nom du donjon");
    
        // Instancier l'objet
        $oDonjon = Donjon::creer($sNomDonjon);
    
        Flight::json(
            array(
                "id_donjon" => $oDonjon->getIdDonjon(),
                "nom_donjon" => $oDonjon->getNomDonjon()
            )
        );
        
});

    


Flight::route('GET /personnages', function(){
    $sPersonnages = Personnage::all();
    
        foreach($sPersonnages as $oPersonnage){
            echo $oPersonnage->getNomPersonnage();
        }

});
Flight::route('PUT /perso/@nom_perso/@pdv_perso', function($sNomPersonnage, $iPddPersonnage){

    // vérifier l'existence de l'objet
    if(!isset($sNomPersonnage)) Flight::halt(406, "Il manque le nom du personnage");

    // Instancier l'objet
    $oPersonnage = Personnage::creer($sNomPersonnage, $iPddPersonnage);

    Flight::json(
        array(
            "id_personnage" => $oPersonnage->getIdPersonnage(),
            "nom_personnage" => $oPersonnage->getNomPersonnage(),
            "pdd_personnage" => $oPersonnage->getPddPersonnage()
        )
    );
    
});


Flight::start();
