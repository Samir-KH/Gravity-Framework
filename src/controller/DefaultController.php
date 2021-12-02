<?php


namespace Controller;

use App\Controller\AbstractController;


class DefaultController extends AbstractController{


    public function DefaultMethode(){


        return $this->renderView("Default");
    }

}