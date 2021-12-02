<?php


namespace Controller;

use App\Controller\AbstractController;
use Stream\VideoStream;

class WatchController extends AbstractController{


    public function index($filmName){
        //var_dump($filmName);
        return $this->renderView("StreamingApp");
    }

}