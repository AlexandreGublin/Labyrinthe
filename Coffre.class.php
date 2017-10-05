<?php

require_once("LabyrintheDefaut.class.php");

class Coffre extends LabyrintheDefaut{

    /**
    * @var int
    * @private
    */
    private $_iIdCoffre;

    /**
    * @var int
    * @private
    */
    private $_iPiegeCoffre;

    /**
    * @var string
    * @private
    */
    private $_sTresorCoffre = [

    ];

    /**
    *   @param int $iIdCoffre
    *   @constructor
    */
    public function __construct($iIdCoffre){
        $oConnexion = self::getConnexion();
        $sCoffre = "SELECT * FROM personnage WHERE id_personnage = ".$iIdCoffre;
        $oResult = $oConnexion->query($sCoffre);

        $aCoffre = $oResult->fetch();

        $this->_iIdCoffre = $iIdCoffre;
        $this->_iPiegeCoffre = $aCoffre["piege_coffre"];
        $this->_sTresorCoffre = $aCoffre["tresor_coffre"];
    }


    public static function all(){
        $oConnexion = self::getConnexion();
        $sListCoffres = "SELECT id_coffre, piege_coffre, tresor_coffre FROM coffre";
        $oResult = $oConnexion->query($sListCoffres);

        $aCoffres = array();
        foreach($oResult as $aRow){
            $aCoffres[] = new Coffre($aRow['id_coffre']);
        }

        return $aCoffres;
    }

    // /**
    // *   @param string $sNomPersonnage
    // *   @param int $iPdd_personnage
    // *   @constructor
    // */
    // public static function creer ($sNomPersonnage, $iPdd_personnage){
    //     $oConnexion = self::getConnexion();

    //     $sRequete = "INSERT INTO personnage (nom_personnage, pdd_personnage) VALUES ('". $sNomPersonnage ."', ". $iPdd_personnage .")";

    //     $oResult = $oConnexion->query($sRequete);

    //     $oPersonnage = new Personnage($oConnexion->lastInsertId());

    //     return $oPersonnage;

    // }

    /**
    *   Retourne l'id du coffre
    *   @return int Id du coffre
    */
    public function getIdCoffre(){
        return $this->_iIdCoffre;
    }

    /**
    *   Retourne un nombre entre 0 et 100, si 0 non piégé, le nombre représente les points de vie perdues
    *   @return int Nombre de points de vie perdu
    */
    public function getPiegeCoffre(){
        return $this->_iPiegeCoffre;
    }

    public function setPiegeCoffre($iPiegeCoffre){
        $oConnexion = self::getConnexion();
        $sRequete = "UPDATE coffre SET piege_personnage = ". $iPiegeCoffre ." WHERE id_coffre = ".$this->_iIdCoffre;
        $oConnexion->exec($sRequete);
        $this->_iPiegeCoffre = $iPiegeCoffre;
    }


}
