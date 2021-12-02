<?php
/**
 * this class require a parial response type
 * it returns a PartialResponse object and when we execute the method send the stram starts
 */
namespace Stream;

use App\HttpComponents\Request;
use App\HttpComponents\PartialResponse;


class VideoStream
{

    private $file;
    private $size;
    private $buffer = 1024*8;
    private $headers_bag;
    private $start;
    private $end;
    private $canStream = true ;
    public $status;
    private $request;

    public function __construct($file, $request)
    {
        $this->file = fopen($file,'rb');
        $this->size = filesize($file);
        $this->headers_bag['Content-type'] = mime_content_type($file);
        $this->request = $request;
    }

    private function checkPartialRequest($request)
    {
        $this->start = 0;
        $this->end = $this->size-1;
        if ($range = $request->getHeader('HTTP_RANGE'))
        {
            $list = explode('-', substr($range, 6));
            $this->start = $list[0];
            $this->end = (isset($list[1]) and  is_numeric($list[1])) ? $list[1] :$this->size-1;
            if (strlen($this->start) < 1){
                $this->start = $this->size - $this->end;
            }
            return true;
        }
        return false;
    }

    private function prepareHeadersBag()
    { 

        if (!$this->checkPartialRequest($this->request))
        {
            //$this->headers_bag['Content-Length'] = $this->size;
            $this->status= "HTTP/1.1 400 Bad request";
            $this->canStream = false ;
            return;
        }
        if( $this->end<$this->start)
        {
            $this->status= "HTTP/1.1 416 Requested Range Not Satisfiable";
            $this->canStream = false ;
        }
        else $this->status= "HTTP/1.1 206 Partial Content";
            
        $this->headers_bag['Acccept-Ranges'] = "0-".$this->end;
        $this->headers_bag['Content-Range'] = "bytes ".$this->start."-".$this->end."/".$this->size;
        $this->headers_bag['Content-Length'] = $this->end - $this->start + 1;
    }

    public function get_headers_bag()
    {
        return $this->headers_bag;
    }

    public function startStream()
    {
        if ( !$this->canStream)
            return false;
        $pos = $this->start;
        fseek($this->file,$pos);
        while(!feof($this->file)  and ($pos <= $this->end ))
        {
            set_time_limit(0);
            $buffer = $this->buffer;
            if ($pos + $buffer > $this->end )
                $buffer = $this->end - $pos + 1;
            $data = fread($this->file, $buffer);
            echo $data;
            flush();
            ob_flush();
            $pos += $buffer;
        }
        return true;
    }
    public function endStream()
    {
        fclose($this->file);
        exit;
    }

    public static function PartialRequestWithStreamObject($file, $request)
    {
        $partialResponse = new PartialResponse();
        $streamObject = new VideoStream($file, $request);
        $streamObject->prepareHeadersBag();
        $partialResponse->setHeaders($streamObject->get_headers_bag());
        $partialResponse->setStramObject($streamObject);
        return $partialResponse;
    }
}