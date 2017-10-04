<?php 
require_once("donjon.class.php");
require_once("personnage.class.php");
require('flight/Flight.php');


Flight::route('/', function(){
    echo 'hello world!';
});


// Récuperer les donjons
Flight::route('GET /donjons', function(){
    $sListeDonjons = Donjon::all();
});
// Créer un nouveau donjon
Flight::route('PUT /donjon/@nom_donjon', function($sNomDonjon){
    
    // vérifier l'existence de l'objet
    if(!isset($sNomDonjon)) Flight::halt(406, "Il manque le nom du donjon");

    // Créer le donjon
    $oDonjon = Donjon::creer($sNomDonjon);

    Flight::json(
        array(
            "id_donjon" => $oDonjon->getIdDonjon(),
            "nom_donjon" => $oDonjon->getNomDonjon()
        )
    );
        
});




// Mettre un personnage dans un donjon
Flight::route('POST /personnage/@id_perso/donjon/@id_donjon', function($iIdPersonnage, $iIdDonjon){
        
        // savoir si le donjon existe et l'initialisé
        $oDonjon = new Donjon($iIdDonjon);

        // créer le parcours
        $aResult = $oDonjon->entrer($iIdPersonnage, $iIdDonjon);


        // renvoyer la pièce d'entrée du donjon et les sortie possible :
        // Allez insérer dans parcours que l'on est dans une piece et chercher dans plan
        // les 3 sortie de notre pièce (le plan dois être entierement préparé avant)
        Flight::json(
            array(
            "id_piece" => $aResult["id_piece"],
            "id_pieces_possibles" => array(1)
        ));
});




//le joueur rentre dans une pièce (vérifier la possibilité)
Flight::route('POST /personnage/@id_personnage/piece/@id_piece', function($iIdPersonnage, $iIdPiecesPrecedentes){

    // //contenu
    // $iIdPiecesPrecedentes = Flight::request()->data->id_piece_precedente;

    // si pièce vide
    FLIGHT::json(array(
        "id_piece" => 72,
        "id_pieces_possibles" => [89,45,87],
        "id_piece_precedente" => 56  
    ));

    // si monstre et / ou coffre
    FLIGHT::json(array(
        "id_piece" => 72,
        "id_pieces_possibles" => [89,45,87],
        "id_piece_precedente" => 56,        
        "monstre" => [
                "id_monstre" => 743,
                "nom_monstre" => "Lutin démoniaque",
                "pdv_montre" => 100
            ],
        "id_coffre" => 987
    ));
});



// si l'utilisateur décide de combattre un monstre
Flight::route('POST /personnage/@id_perso/piece/@id_piece/monstre/@id_monstre/combattre', 
    function($iIdPersonnage, $iIdPiece, $iIdMonstre){
   
    // monstre existant dans la piece oui/non

    // monstre déja combattu oui/non

    //combattre

    //resultat de la route
    FLIGHT::json(array(
        "pdv_perso" => 80  // 0 si il a perdu
    ));
});
// si l'utilisateur décide de fuir
Flight::route('POST /personnage/@id_perso/piece/@id_piece/monstre/@id_monstre/fuir', 
    function($iIdPersonnage, $iIdPiece, $iIdMonstre){

    // //contenu
    // $iIdPiecesPrecedentes = Flight::request()->data->id_piece_precedente;

    FLIGHT::json(array(
        "pdv_perso" => 95   //points de vie perdu aléatoire entre 1 et 10
    ));
});





// Lorsque le perso ouvre un coffre
Flight::route('POST /personnage/@id_perso/piece/@id_piece/coffre/@id_coffre/ouvrir', 
    function($iIdPersonnage, $iIdPiece, $iIdCoffre){
    
    // vérifier si un coffre (id_coffre) existe dans la piece

    // vérifier si le coffre a déja été ouvert

    // piéger oui / non

    //resultat de la route
    FLIGHT::json(array(
        "id_coffre" => 987,
        "piege_coffre" => 12,   // piege retire des points de vie, si 0 coffre non piégé
        "tresor" => [           // uniquement si il y a un trésor
                "id_tresor" => 23,
                "nom_tresor" => "Epee lourde"
        ]
    ));
});
//donne des infos sur le coffre
Flight::route('GET /personnage/@id_perso/piece/@id_piece/coffre/@id_coffre/ouvrir', 
    function($iIdPersonnage, $iIdPiece, $iIdCoffre){

    // coffre existant oui non

    //resultat de la route
    FLIGHT::json(array(
        "id_coffre" => 987,
        "piege_coffre" => 12,   // piege retire des points de vie, si 0 coffre non piégé
        "tresor" => [           // uniquement si il y a un trésor
                "id_tresor" => 23,
                "nom_tresor" => "Epee lourde"
        ]
    ));
});


// Renvoie tous les personnages
Flight::route('GET /personnages', function(){
    $sPersonnages = Personnage::all();
    
    $aListePersonnages = [];
    $aListePersonnages2 = [];
    $i = 0;

    foreach($sPersonnages as $oPersonnage){
        $aListePersonnages = [
            $i => $aListePersonnages2 = [
                "id_personnage" => $oPersonnage->getIdPersonnage(),
                "nom_personnage" => $oPersonnage->getNomPersonnage(),
                "pdd_personnage" => $oPersonnage->getPddPersonnage()
            ]
        ];

        $i++;
    }

    echo json_encode($aListePersonnages);  
    //resultat de la route
    // FLIGHT::json(array(
        
    // ));
    // }

});
// Créer un nouveau personnage
Flight::route('PUT /personnage/@nom_perso', function($sNomPersonnage){

    // vérifier l'existence de l'objet
    if(!isset($sNomPersonnage)) Flight::halt(406, "Il manque le nom du personnage");

    // Instancier l'objet
    $oPersonnage = Personnage::creer($sNomPersonnage);

    Flight::json(
        array(
            "id_personnage" => $oPersonnage->getIdPersonnage(),
            "nom_personnage" => $oPersonnage->getNomPersonnage(),
            "pdd_personnage" => $oPersonnage->getPddPersonnage()
        )
    );
    
});


Flight::start();
