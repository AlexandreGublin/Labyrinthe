<?php 

// tresor

// coffre : ouvrir (vide, piégé, tresor)

// monstre: fuir / combattre (resolution aléatoire du combat pondéré au nombre de trésor)

// piece carré : (départ, neutre, sortie)
// pièce : 1 porte par pièce

// personnage : point de vie

// donjon 


POST    perso (nom, pdd)

PUT     perso / entree   (id_perso, id_donjon) -- id_piece_en_cour


        perso / piece    (id_perso, id_piece) -- id_piece_en_cour, id_piece_visitable



        -------------------------------------------------

Utiliser post pour les actions utilisateurs :

// Créer personnage
PUT     /perso  
sortie ->
{
        "id_personnage"
        "nom_personnage"
        "pdd_personnage"
}

// Placer un perso dans un donjon
POST    /perso/@id_perso/donjon/@id_donjon
sortie ->
{
        "id_piece":56,
        "id_pieces_possibles":[89,45,87]
}

//le joueur rentre dans une pièce (vérifier la possibilité)
POST    personnage/@id_personnage/piece/@id_piece
entre ->
{
        "id_piece_precedente":[]
}
sortie -> Pièce vide
{
        "id_piece":72,
        "id_pieces_possibles":[89,45,87],
        "id_piece_precedente":56        
}
sortie -> Pièce monstre et / ou coffre
{
        "id_piece":72,
        "id_pieces_possibles":[89,45,87],
        "id_piece_precedente":56        
        "monstre" : {
                "id_monstre": 743,
                "nom_monstre": "Lutin démoniaque",
                "pdv_montre": 100
        },
        "id_coffre":987
}

// si l'utilisateur ouvre un coffre
POST    /perso/@id_perso/piece/@id_piece/coffre/@id_coffre/ouvrir
sortie ->
{
        "id_coffre":987,
        "piege_coffre":12,  // piege retire des points de vie, si 0 coffre non piégé
        "tresor":{ // uniquement si il y a un trésor
                "id_tresor":23,
                "nom_tresor":"Epee lourde"
        }
}

//donne des infos sur le coffre
GET    /perso/@id_perso/piece/@id_piece/coffre/@id_coffre/ouvrir
sortie ->
{
        "id_coffre":987,
        "piege_coffre":12,  // piege retire des points de vie, si 0 coffre non piégé
        "tresor":{ // uniquement si il y a un trésor
                "id_tresor":23,
                "nom_tresor":"Epee lourde"
        }
}

// si l'utilisateur décide de combattre un monstre
POST    /perso/@id_perso/piece/@id_piece/monstre/@id_monstre/combattre
sortie ->
{
        "pdv_perso":80  // 0 si il a perdu
}

// si l'utilisateur décide de fuir
POST    /perso/@id_perso/piece/@id_piece/monstre/@id_monstre/combattre
entree ->
{
        "id_piece_precedente":98
}
sortie ->
{
        "pdv_perso":95   //points de vie perdu aléatoire entre 1 et 10
}






// récupérer les informations du joueur
GET     /donjon/personnage







