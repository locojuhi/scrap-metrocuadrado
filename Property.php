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
    function getId() {
        return $this->id;
    }

    function getPrice() {
        return $this->price;
    }

    function getName() {
        return $this->name;
    }

    function getUrl() {
        return $this->url;
    }

    function getNeighborhood() {
        return $this->neighborhood;
    }

    function getStratum() {
        return $this->stratum;
    }

    function getPrivateArea() {
        return $this->privateArea;
    }

    function getBuildArea() {
        return $this->buildArea;
    }

    function getRoom() {
        return $this->room;
    }

    function getBathroom() {
        return $this->bathroom;
    }

    function getLevel() {
        return $this->level;
    }

    function getBuildingTime() {
        return $this->buildingTime;
    }

    function getLatitud() {
        return $this->latitud;
    }

    function getLongitud() {
        return $this->longitud;
    }

    function setId($id) {
        $this->id = $id;
    }

    function setPrice($price) {
        $this->price = $price;
    }

    function setName($name) {
        $this->name = $name;
    }

    function setUrl($url) {
        $this->url = $url;
    }

    function setNeighborhood($neighborhood) {
        $this->neighborhood = $neighborhood;
    }

    function setStratum($stratum) {
        $this->stratum = $stratum;
    }

    function setPrivateArea($privateArea) {
        $this->privateArea = $privateArea;
    }

    function setBuildArea($buildArea) {
        $this->buildArea = $buildArea;
    }

    function setRoom($room) {
        $this->room = $room;
    }

    function setBathroom($bathroom) {
        $this->bathroom = $bathroom;
    }

    function setLevel($level) {
        $this->level = $level;
    }

    function setBuildingTime($buildingTime) {
        $this->buildingTime = $buildingTime;
    }

    function setLatitud($latitud) {
        $this->latitud = $latitud;
    }

    function setLongitud($longitud) {
        $this->longitud = $longitud;
    }

    public function save(){
        include './ConnectionDB.php';
        $data = new ConnectionDB();
        $db = $data->con;
        if(!empty($this->price) && !empty($this->name) && !empty($this->url && !empty($this->neighborhood))){
            $insert = $db->prepare("insert into properties (activo, vendido, calificacion, precio, nuevo, remate, metros, estrato, banos, parqueaderos, habitaciones, ascensor, direccion, googlemap, streetviewm, description, opcional) values (:activo, :vendido, :calificacion, :precio, :nuevo, :remate, :metros, :estrato, :banos, :parqueaderos, :habitaciones, :ascensor, :direccion, :googlemap, :streetviewm, :description, :opcional)");
            $sentencia->execute(":activo" => 1, ":vendido" => 0, ":calificacion" => 5, ":precio" => , ":nuevo" => , ":remate" => , ":metros" => , ":estrato" => , ":banos" => , ":parqueaderos" => , ":habitaciones" => , ":ascensor" => , ":direccion" => , ":googlemap" => , ":streetviewm" => , ":description" => , ":opcional" => );
            
        }
        $this->price;
        $this->name;
        $this->url;
        $this->neighborhood;
        
        $this->stratum;
        $this->privateArea;
        $this->buildArea;
        $this->room;
        $this->bathroom;
        $this->level;
        $this->buildingTime;
        $this->latitud;
        $this->longitud;
    
    }

}
