<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Property
 *
 * @author USER
 */
class Property {
    //put your code here
    public $id;
    public $price;
    public $name;
    public $url;
    
    public $neighborhood;
    public $stratum;
    public $privateArea;
    public $buildArea;
    public $room;
    public $bathroom;
    public $level;
    public $buildingTime;
    public $latitud;
    public $longitud;
    
    
    function __construct($price, $name, $url, $metadata, $latitud, $longitud) {
        $this->price = $price;
        $this->name = $name;
        $this->url = $url;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $indexarray = array();
        $valuesarray = array();
        $arrayuotput = array();
        echo "<hr>";
        for ($i = 0; $i <= count($metadata)-1; $i++) {
            if(($i % 2) == 0){
                array_push($indexarray,$metadata[$i]);
            }else{
                array_push($valuesarray,$metadata[$i]);
            }
        }
        $arrayuotput = array_combine ( $indexarray , $valuesarray );
        echo "<pre>";
        echo "</pre>";
        foreach ($arrayuotput as $key => $value) {
            if(preg_match ('/Barrio/' , utf8_encode($key))){
                $this->neighborhood = utf8_encode($value);
            }elseif (preg_match ('/Estrato/' , utf8_encode($key))) {
                $this->stratum = utf8_encode($value);
            }elseif (preg_match ('/(.rea\Wprivada)/' , utf8_encode($key))) {
                $this->privateArea = utf8_encode($value);
            }elseif (preg_match ('/(.rea\Wconstruida)/' , utf8_encode($key))) {
                $this->buildArea = utf8_encode($value);
            }elseif (preg_match ('/(.rea\WConstruida)/' , utf8_encode($key))) {
                $this->buildArea = utf8_encode($value);
            }elseif (preg_match ('/(.rea)/' , utf8_encode($key))) {
                $this->privateArea = utf8_encode($value);
            }elseif (preg_match ('/Habitaciones/' , utf8_encode($key))) {
                $this->room = $value;
            }elseif (preg_match ('/Ba(.*)os/' , utf8_encode($key))) {
                $this->bathroom = $value;
            }elseif (preg_match ('/Tiempo de Construcción/' , utf8_encode($key))) {
                $this->buildingTime = utf8_encode($value);
            }
        }
    }

}
