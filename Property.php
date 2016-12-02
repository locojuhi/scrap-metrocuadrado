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
    public $propertyType;
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
    
    
    function __construct($price, $name, $url, $metadata, $latitud, $longitud, $type) {
        preg_match("/\d+/",preg_replace("/\./","", preg_replace ("/(\t)/","", preg_replace("/ /","",$price))), $innerprice);
        //print_r($innerprice);
        $this->price = $innerprice['0'];
        $this->name = $name;
        $this->url = $url;
        $this->latitud = $latitud;
        $this->longitud = $longitud;
        $this->propertyType = $type;
        $indexarray = array();
        $valuesarray = array();
        $arrayuotput = array();
        for ($i = 0; $i <= count($metadata)-1; $i++) {
            if(($i % 2) == 0){
                array_push($indexarray,$metadata[$i]);
            }else{
                array_push($valuesarray,$metadata[$i]);
            }
        }
        $arrayuotput = array_combine ( $indexarray , $valuesarray );
        foreach ($arrayuotput as $key => $value) {
            if(preg_match ('/Barrio/' , utf8_encode($key))){
                $this->neighborhood = preg_replace ("/(\t)/","", preg_replace("/(\s)/", "", $value));
            }elseif (preg_match ('/Estrato/' , utf8_encode($key))) {
                $this->stratum = preg_replace ("/(\t)/","", preg_replace("/(\s+)/", "",$value));
            }elseif (preg_match ('/(.rea\Wprivada)/' , utf8_encode($key))) {
                $this->privateArea = preg_replace ("/(\t)/","", preg_replace("/(\s+)/","", preg_replace("/(mts2)/","",$value)));
            }elseif (preg_match ('/(.rea\Wconstruida)/' , utf8_encode($key))) {
                $this->buildArea = preg_replace ("/(\t)/","", preg_replace("/(\s+)/","", preg_replace("/(mts2)/","",$value)));
            }elseif (preg_match ('/(.rea\WConstruida)/' , utf8_encode($key))) {
                $this->buildArea = preg_replace ("/(\t)/","", preg_replace("/(\s+)/","", preg_replace("/(mts2)/","",$value)));
            }elseif (preg_match ('/(.rea)/' , utf8_encode($key))) {
                $this->privateArea = preg_replace ("/(\t)/","", preg_replace("/(\s+)/", "",$value));
            }elseif (preg_match ('/Habitaciones/' , utf8_encode($key))) {
                $this->room = preg_replace ("/(\t)/","", preg_replace("/(\s+)/", "",$value));
            }elseif (preg_match ('/Ba(.*)os/' , utf8_encode($key))) {
                $this->bathroom = preg_replace ("/(\t)/","", preg_replace("/(\s+)/", "",$value));
            }elseif (preg_match ('/Tiempo de Construcción/' , utf8_encode($key))) {
                $this->buildingTime = preg_replace ("/(\t)/","", preg_replace("/(\s+)/", "",$value));
            }
        }
        switch ($this->propertyType) {
            case 'Apartamento':
                $this->propertyType = 2;
            break;
            case 'Casa':
               $this->propertyType = 1; 
            break;
            case 'Local':
               $this->propertyType = 3; 
            break;
            case 'Oficina':
               $this->propertyType = 4; 
            break;
            case 'Bodega':
               $this->propertyType = 5; 
            break;
            case 'Finca':
               $this->propertyType = 6; 
            break;
            case 'Lote':
               $this->propertyType = 7; 
            break;

        }
        //$this->save();
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
        if(!empty($this->price) && !empty($this->name) && !empty($this->url && !empty($this->neighborhood && !empty($this->buildArea)))){
            try {
                $data = new ConnectionDB();
                $db = $data->con;
                $insert = $db->prepare("INSERT INTO inmueble (fecharegistro, activo, vendido, calificacion, precio, nuevo, remate, metros, estrato, banos, parqueaderos, habitaciones, ascensor, direccion, googlemap, streetview, descripcion, opcional2 , url, idtipoinversion, idedadinmueble, idacabados, idzona, opcional3, idciudadinmueble) VALUES ((select curdate()),:activo, :vendido, :calificacion, :precio, :nuevo, :remate, :metros, :estrato, :banos, :parqueaderos, :habitaciones, :ascensor, :direccion, :googlemap, :streetview, :description, :opcional, :url, :tipo, :idedadinmueble, :idacabados, :idzona, :opcional3, :idciudadinmueble)");
                $query = $insert->execute(array(
                    ":activo" => 0, 
                    ":vendido" => 0,
                    ":calificacion" => 5,
                    ":precio" => $this->price,
                    ":nuevo" => 1, 
                    ":remate" => 0, 
                    ":metros" => $this->buildArea, 
                    ":estrato" => $this->stratum, 
                    ":banos" => $this->bathroom, 
                    ":parqueaderos" => 0, 
                    ":habitaciones" => $this->room, 
                    ":ascensor" => 0, 
                    ":direccion" => $this->neighborhood, 
                    ":googlemap" => $this->longitud.','.$this->latitud, 
                    ":streetview" => 0, 
                    ":description" => 0, 
                    ":opcional" => 0, 
                    ":url" => $this->url,
                    ":tipo" => $this->propertyType,
                    ":idedadinmueble" =>3, 
                    ":idacabados" =>3, 
                    ":idzona" =>11, 
                    ":opcional3" => 1789,
                    ":idciudadinmueble" => 321));
                if($query){
                    echo "Agregado en la base de datos: ".$this->url;
                }else{
                    echo "No se ha agregado en la base de datos: ".$this->url;
                    echo "<h1>parametros enviados:</h1>";
                    echo "<pre>";
                    echo "activo: " . "1"."<br>";
                    echo "vendido: " ."0"."<br>"; 
                    echo "calificacion: " . "5"."<br>";
                    echo "precio: " . $this->price."<br>"; 
                    echo "nuevo: " . "0"."<br>";
                    echo "remate: " . "0"."<br>"; 
                    echo "metros: " . $this->buildArea."<br>";
                    echo "estrato: " . $this->stratum."<br>"; 
                    echo "banos: " . $this->bathroom."<br>";
                    echo "parqueaderos: " . "0"."<br>";
                    echo "habitaciones: " . $this->room."<br>";
                    echo "ascensor: " . "0"."<br>"; 
                    echo "direccion: " . $this->neighborhood."<br>";
                    echo "googlemap: " . $this->longitud.",".$this->latitud."<br>";
                    echo "streetview: " . "0"."<br>";
                    echo "description: " . "0"."<br>";
                    echo "opcional: " . "0"."<br>";
                    echo "IdtipoInmueble: " . $this->propertyType."<br>";
                    echo "</pre>";
                    echo "<hr>";
                }
            } catch (Exception $exc) {
                echo $exc->getTraceAsString();
            }  
        }
    }

}
