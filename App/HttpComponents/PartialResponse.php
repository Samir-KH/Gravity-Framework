<?PHP 
/**
 * This file is a part of this mini framwork
 * This class is a part of httpComponents of this mini framwork in another word the core
 * this class extends Response class
 * this class require a stream class with  startStrem and endEnd methods
 */
namespace App\HttpComponents;



class PartialResponse extends Response{

    private $streamObject; 

    public function __construct()
    {
    }
    
    public function setStramObject($stream_object)
    {
        $this->streamObject = $stream_object;
    }

    public function send()
    {
        $this->sendHeaders();
        header($this->streamObject->status);

        if ($this->streamObject!= null)
        {
            $this->streamObject->startStream();
            $this->streamObject->endStream();
        }

    }
}