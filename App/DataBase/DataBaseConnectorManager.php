<?php
/**
 * This file is a part of this mini framwork
 * This class is the router of this mini framwork 
 * the handling with the bad definitions is almoste done  !!!!!!!!!
 * 
 *but the management of the bad definitions route file is not yet complete !!!!!!!!!
 */
namespace App\DataBase;
use \mysqli;

class DataBaseConnectorManager{

    private $dataBases;
    private $dataBaseConnectors = array();

    public function __construct($dataBases){
        $this->dataBases = $dataBases;
    }

    public function getdatabaseConnectors($connectorName){
        if (isset($this->dataBaseConnectors[$connectorName])){
            return $this->dataBaseConnectors[$connectorName];
        }
        else{
            $database = $this->dataBases->$connectorName;
            $connector = new mysqli($database->host, $database->user, $database->password, $database->name);
            $connector->set_charset("utf8");
            $this->dataBaseConnectors[$connectorName] = $connector;
            return $connector;
        }
    }
    public function getDefaultConnector(){
        return $this->getdatabaseConnectors("default");
    }
}