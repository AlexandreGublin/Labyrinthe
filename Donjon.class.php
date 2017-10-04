<?php

require_once("LabyrintheDefaut.class.php");

class Donjon extends LabyrintheDefaut{

    /**
    * @var int 
    * @private
    */
    private $_iIdDonjon;

    /**
    * @var string 
    * @private
    */
    private $_sNomDonjon;

    /**
    *   @param int $iIdDonjon 
    *   @constructor
    */
    public function __construct($iIdDonjon){ 
        $oConnexion = self::getConnexion();
        $sNomDuDonjon = "SELECT nom_donjon FROM donjon WHERE id_donjon = ".$iIdDonjon;
        $oResult = $oConnexion->query($sNomDuDonjon);

        if($oResult){
            $sDonjon = $oResult->fetch();
            
            $this->_sNomDonjon = $sDonjon["nom_donjon"];
            $this->_iIdDonjon = $iIdDonjon;
        }else{

        }
                               
    }

    public static function all(){
        $oConnexion = self::getConnexion();
        $sListDonjons = "SELECT id_donjon, nom_donjon FROM donjon ORDER BY nom_donjon";
        $oResult = $oConnexion->query($sListDonjons);

        $aDonjon = array();
        foreach($oResult as $aRow){
            $aDonjon[] = new Donjon($aRow['id_donjon']);
        }
        
        return $aDonjon;
    }

    /**
    *   @param string $sNomDonjon 
    *   @constructor
    */
    public static function creer ($sNomDonjon){ 
        $oConnexion = self::getConnexion();

        $sRequete = "INSERT INTO donjon (nom_donjon) VALUES ('". $sNomDonjon ."')";        

        $oConnexion->query($sRequete);  

        $oDonjon = new Donjon($oConnexion->lastInsertId());
        
        return $oDonjon;
    
    }

    public function entrer ($iIdPersonnage, $iIdDonjon){

        $oConnexion = self::getConnexion();

        // vérifier que le personnage n'est pas deja dans le donjon
        $sRequete = "SELECT COUNT(pi.id_piece) as 'isDonjonEnCour'  
        FROM piece pi 
        INNER JOIN donjon d 
        ON pi.id_donjon_piece = d.id_donjon 
        INNER JOIN parcours par 
        ON pi.id_piece = par.id_piece_parcours 
        WHERE d.id_donjon  = ". $iIdDonjon ." 
        AND par.id_personnage_parcours = ".$iIdPersonnage;
        $aResult = $oConnexion->query($sRequete);
        $iNbDonjons = $aResult->fetch();

        // Si personnage déja dans le donjon alors résultat > 0
        if($iNbDonjon["isDonjonEnCour"] == 0){

            // Récupérer la piece "entrée" du donjon
            $sRequete = "SELECT pi.id_piece 
            FROM piece pi
            WHERE pi.id_donjon_piece = ". $iIdDonjon ." 
            AND pi.entree_piece = 1";
            $aResult = $oConnexion->query($sRequete);
            $aResultFetch = $aResult->fetch();
            $iIdPieceDepart =  $aResultFetch["id_piece"];

            // $date = new DateTime();
            // echo $date->format('Y-m-d H:i:s');

            // Insérer le personnage dans la pièce d'entrée
            $sRequete = "INSERT INTO parcour (id_personne, id_piece) VALUES (". $iIdPersonnage .",  ". $iIdPieceDepart .")";
            $oConnexion->query($sRequete);  

            //renvoyer l'id de la la pièce en cour et les id des pièces de sortie
            $aResult = [
                "id_piece" => $iIdPieceDepart,
                "id_pieces_possibles"
            ];
        
        return $aResult;

        }
    }

    /**
    *   Retourne le nom du donjon
    *   @return int Nom du donjon 
    */
    public function getIdDonjon(){
        return $this->_iIdDonjon;
    }

    /**
    *   Retourne le nom du donjon
    *   @return string Nom du donjon 
    */
    public function getNomDonjon(){
        return $this->_sNomDonjon;
    }

    /**
    *   @param string $sNomDonjon 
    */
    public function setNomDonjon($sNomDonjon){
        $oConnexion = self::getConnexion();
        $sRequete = "UPDATE donjon SET nom_donjon = '". $sNomDonjon ."' WHERE id_donjon = ".$this->_iIdDonjon;
        $oConnexion->exec($sRequete);
        $this->_sNomDonjon = $sNomDonjon;
    }

}