<?php



/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ConnectionDB
 *
 * @author USER
 */
class ConnectionDB {
    protected $pass = 'DyservetTu@liado8';
    protected $user = 'tucasasa_dyserve';
    protected $host = 'localhost';
    protected $db = 'tucasasa_dyservet';
    public $con;
    function __construct() {
        $this->con = new PDO('mysql:host='.$this->host.';dbname='.$this->db.'', $this->user, $this->pass);
    }
}
