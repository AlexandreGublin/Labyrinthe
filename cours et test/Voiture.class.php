<?php

class Voiture{

    /**
    * @var int 
    * @private
    */
    private $_iMoteur;

    /**
    * @var int 
    * @private
    */
    private $_iPassagers;

    /**
    * @var string 
    * @private
    */
    private $_sAction;

    /**
    *   @param int $sMoteur 
    *   @param int $iPassagers 
    *   @constructor
    */
    public function __construct($iMoteur, $iPassagers, $sAction){ 
        $this->_iMoteur = $iMoteur;                             
        $this->_iPassagers =  $iPassagers;                     
        $this->_sAction = $sAction;
    }

    /**
    *   @return string
    */
    public function GetMoteur(){
        return $this->_iMoteur;
    }

    public function SetMoteur($iMoteur){
        $this->_iMoteur = $iMoteur;
    }

    /**
    *   @return string
    */
    public function GetNbPassagers(){
        return $this->_iPassagers;
    }
    
    public function SetNbPassagers($iNbPassagers){
        $this->_iPassagers = $iNbPassagers;
    }

    /**
    *   @return string
    */
    public function GetActionVoiture(){
        return $this->_sAction;
    }
    
    public function SetActionVoiture($sAction){
        $this->_sAction = $sAction;
    }




}

