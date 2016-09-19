<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ScrapUrl
 *
 * @author Danny Torres
 */
include './Property.php';
include './simple_html_dom.php'; 
class ScrapUrl {
    public $url;
    function __construct($url) {
        $this->url = $url;
        $this->ExecuteUrlScrapper();
    }
    public function  ExecuteUrlScrapper(){
        $numberIdObject = 1;
        $site = new simple_html_dom();
        $site->load_file($this->url);
        //encontrar el nombre del inmueble
        $title = $site->find('h1[itemprop=name]', 0)->plaintext;
        //encontrar el precio del inmueble
        $price = $site->find('b[itemprop=price]', 0)->plaintext;
        //encontrar la informacion generar contenida en una lista desordenada
        $info = $site->find('div[id=info_nombre] ul', 0);
        //encontrar latiud dede donde esta ubicado el inmueble
        $latitud = $site->find('input[id=latitud]');
        //encontrar la longitud de donde esta ubicado el inmueble
        $longitud = $site->find('input[id=longitud]'); 
        //preg_match('/(\$.*\d)/', $link, $coincidenciasprice);
        //preg_match('/(.*[a-z])/', $link, $coincidenciastitle);
        //$price = $coincidenciasprice[0];
        //$title = $coincidenciastitle[0];
        $description = array();
        foreach($info->find('li') as $li){
            array_push($description, $li->plaintext);
        }
        foreach($latitud as $latituds){
            $latitud = $latituds->attr['value'];
        }
        foreach($longitud as $longituds){
            $longitud = $longituds->attr['value'];
        }
        $site->clear(); 
        unset($site);
        $object = new Property($price, $title, $this->url, $description, $latitud, $longitud);
        
        $object->save();
    }

}
