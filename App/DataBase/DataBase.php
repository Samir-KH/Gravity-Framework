<?php
/**
 * This file is a part of this mini framwork
 * This class is the router of this mini framwork 
 * the handling with the bad definitions is almoste done  !!!!!!!!!
 * 
 *but the management of the bad definitions route file is not yet complete !!!!!!!!!
 */
namespace App\DataBase;


class AbstractDataBaseManager{

    private $dataBaseConnector;

    public function __construct($dataBaseConnector){
        $this->dataBaseConnector = $dataBaseConnector;
    }
}