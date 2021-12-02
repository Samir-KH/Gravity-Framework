<?php


namespace Controller;

use App\Controller\AbstractController;
use Stream\VideoStream;

class StreamController extends AbstractController{


    public function stream(){
        
        $file = $this->getFromPrivate("[EgyBest].Iron.Man.2.2010.BluRay.1080p.x264.mp4");
        return VideoStream:: PartialRequestWithStreamObject($file,$this->request);
    }

}