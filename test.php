<?php
/*Dont Use!*/
    include './Property.php';
    include './simple_html_dom.php';
    $site = new simple_html_dom();
    $site->load_file('http://www.metrocuadrado.com/web/casas/nuevos/venta/c:bogota');
    $dls = $site->find('dl');
    foreach($dls as $dl){
        $link = $dl->find('a', 1)->plaintext;
        $url = $dl->find('a', 1)->attr['href'];
        
        //traveling to other url
        $detailsSite = new simple_html_dom();
        $detailsSite->load_file($url);
        $info = $detailsSite->find('div[id=info_nombre] ul', 0);
        $latitud = $detailsSite->find('input[id=latitud]');
        $longitud = $detailsSite->find('input[id=longitud]'); 
        preg_match('/(\$.*\d)/', $link, $coincidenciasprice);
        preg_match('/(.*[a-z])/', $link, $coincidenciastitle);
        $price = $coincidenciasprice[0];
        $title = $coincidenciastitle[0];
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
        $detailsSite->clear(); 
        unset($detailsSite);
        $object = new Property($price, $title, $url, $description, $latitud, $longitud);
        
        echo "<br>";
        echo "title ".$object->name;
        echo "<br>";
        echo "price ".$object->price;
        echo "<br>";
        echo "barrio ".$object->neighborhood;
        echo "<br>";
        echo "stato ".$object->stratum;
        echo "<br>";
        echo "url ".$object->url;
        echo "<br>";
        echo "area privada ".$object->privateArea;
        echo "<br>";
        echo "area de construccion ".$object->buildArea;
        echo "<br>";
        echo "habitaciones ".$object->room;
        echo "<br>";
        echo "Baños ".$object->bathroom;
        echo "<br>";
        echo "Logitud ".$object->latitud;
        echo "<br>";
        echo "Latitud ".$object->longitud;
        echo "<br>";
        
    }
    $site->clear(); 
    unset($site);
      
 ?>
