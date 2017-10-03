<?php

// nos class hérite enfaite de la classe mère std class

class MonObjet{

    const MA_CONSTANTE = "Hello"; // constante en MAJ

    /**
    * @var string une belle variable
    * @private
    */
    private $_iMonEntier;  // les var privées avec _ devant

    public $iMonEntierPublic = 66; 

    // les commentaires juste en dessous sont phpdoc, indispensable en entreprise, permet ensuite de générer une documentation du code
    /**
    *   @param sting $sMonParam Un commentaire
    *   @constructor
    */
    public function __construct($MonParam, &$sMonParam){ // le &$sMonParam est obligé d'être une variable car si l'attribut 
        $this->_iMonEntier = 0;                         //privé est modifié la variable sur l'autre page sera aussi modifier, 
        $this->iMonEntierPublic = 1;                    //en appelle ca la référence
    }

    public static function maMethodeStatique(){
        $aMonJoliTableau = array ();
        // ou = []
        $aMonJoliTableau[0] = "premiere valeur";
        $aMonJoliTableau["indice"] = "une autre valeur";
    }

    private function maMethodePrivee(){
        $this->_iMonEntier ++;
    }

    protected function setMonEntier($iMaNouvelleValeur){
        $this->_iMonEntier = $iMaNouvelleValeur;
    }

    /**
    *   Fonction qui sert a rien
    *   @return string
    */
    public function maFonctionPublique(){
        return "Coucou";
    }

}