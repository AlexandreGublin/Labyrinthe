<?php

require_once("LabyrintheDefaut.class.php");

class Piece extends LabyrintheDefaut{

    // /**
    // * @var int
    // * @private
    // */
    // private $_iIdMonstre;
    //
    // /**
    // * @var string
    // * @private
    // */
    // private $_sNomMonstre;
    //
    // /**
    // * @var int
    // * @private
    // */
    // private $_iPdd_monstre;
    //
    // /**
    // *   @param int $_iIdMonstre
    // *   @constructor
    // */
    // public function __construct($iIdMonstre){
    //     $oConnexion = self::getConnexion();
    //     $sRequete = "SELECT * FROM monstre WHERE id_monstre = ".$iIdMonstre;
    //     $aResult = $oConnexion->query($sRequete);
    //
    //     $aMonstre = $aResult->fetch();
    //
    //     $this->_iIdMonstre = $iIdMonstre;
    //     $this->_sNomMonstre = $aMonstre["nom_monstre"];
    //     $this->_iPdd_monstre = $aMonstre["pdd_vie_monstre"];
    // }
    //
    //
    // public static function all(){
    //     $oConnexion = self::getConnexion();
    //     $aListeMonstres = "SELECT id_monstre, nom_monstre, pdd_vie_monstre FROM monstre ORDER BY nom_monstre";
    //     $aResult = $oConnexion->query($aListeMonstres);
    //
    //     $aMonstre = array();
    //     foreach($aResult as $aRow){
    //         $aMonstre[] = new Monstre($aRow['id_monstre']);
    //     }
    //
    //     return $aMonstre;
    // }
    //
    // /**
    // *   @param string $sNomMonstre
    // *   @constructor
    // */
    // public static function creer ($sNomMonstre){
    //     $oConnexion = self::getConnexion();
    //
    //     $sRequete = "INSERT INTO monstre (nom_monstre, pdd_vie_monstre) VALUES ('". $sNomMonstre ."', 100)";
    //
    //     $oResult = $oConnexion->query($sRequete);
    //
    //     $oMonstre = new Monstre($oConnexion->lastInsertId());
    //
    //     return $oMonstre;
    //
    // }


    public function isMonsterHere($iIdPieceActuelle){
        $oConnexion = self::getConnexion();

        $sRequete = "SELECT p.id_monstre_piece
          FROM piece p
          WHERE p.id_monstre_piece is not null
          AND p.id_piece = ".$iIdPieceActuelle;

        $aResult = $oConnexion->query($sRequete);

        $aResultFetch = $aResult->fetch();

        return $aResultFetch['id_monstre_piece'];
    }

    public function isMonsterDead($iIdMonster){

    }

    // /**
    // *   Retourne l'id du monstre
    // *   @return int Id du monstre
    // */
    // public function getIdMonstre(){
    //     return $this->_iIdMonstre;
    // }
    //
    // /**
    // *   Retourne le nom du monstre
    // *   @return string Nom du monstre
    // */
    // public function getNomMonstre(){
    //     return $this->_sNomMonstre;
    // }
    //
    // public function setNomMonstre($sNomMonstre){
    //     $oConnexion = self::getConnexion();
    //     $sRequete = "UPDATE monstre SET nom_monstre = '". $sNomMonstre ."' WHERE id_monstre = ".$this->_iIdMonstre;
    //     $oConnexion->exec($sRequete);
    //     $this->_sNomMonstre = $sNomMonstre;
    // }
    //
    // /**
    // *   Retourne le nombre de points de vie du monstre
    // *   @return string Pdd du monstre
    // */
    // public function getPddMonstre(){
    //     return $this->_iPdd_monstre;
    // }
    //
    // public function setPddMonstre($iPdd_monstre){
    //
    //     $oConnexion = self::getConnexion();
    //     $sRequete = "UPDATE monstre SET pdd_vie_monstre = '". $iPdd_monstre ."' WHERE id_monstre = ".$this->_iIdMonstre;
    //     $oConnexion->exec($sRequete);
    //     $this->_iPdd_monstre = $iPdd_monstre;
    // }

}
