<?php
include './Scrap.php';
/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
set_time_limit (86400);
$scrap = new Scrap();
$scra2p = new Scrap();
$scrap->Execute('http://www.metrocuadrado.com/web/casa/usados/venta/c:bogota');

