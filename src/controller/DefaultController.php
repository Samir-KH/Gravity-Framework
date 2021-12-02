<?php


namespace Controller;

use App\Controller\AbstractController;


class DefaultController extends AbstractController{


    public function defaultMethode(){


        return $this->renderView("Default");
    }

}