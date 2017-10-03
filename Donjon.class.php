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

        $sDonjon = $oResult->fetch();

        $this->_sNomDonjon = $sDonjon["nom_donjon"];
        $this->_iIdDonjon = $iIdDonjon;                             
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
    *   Retourne le nom du donjon
    *   @return string Nom du donjon 
    */
    public function getNomDonjon(){
        return "Mon Donjon s'appelle ".$this->_sNomDonjon;
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