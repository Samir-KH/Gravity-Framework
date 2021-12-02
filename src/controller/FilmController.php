<?php


namespace Controller;

use App\Controller\AbstractController;


class FilmController extends AbstractController{


    public function film($film, $quality){


        return $this->render("vous choisi ".$film." ".$quality);
    }

}