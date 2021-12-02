<?PHP 
//header("HTTP/1.1 404 Not Found");
/**
 * This file is a part of this mini framwork
 * This class is a part of httpComponents of this mini framwork in another word the core
 * 
 */
namespace App\HttpComponents;

class Response{

    private $content;
    private $headers_bag;
    public $status; //c'est pour le moment


    public function __construct($content = "")
    {
        $this->content = $content ;
    }

    public function setContent($content)
    {
        $this->content = $content;
    }

    public function setHeader($header_name, $value)
    {
        $this->headers_bag[$header_name] = $value;
    }

    public function setHeaders($headers_bag)
    {
        $this->headers_bag = $headers_bag;
    }


    public function sendHeaders()
    {
        foreach($this->headers_bag as $header_name => $value)
            header($header_name.": ".$value);
        header($this->status);
    }

    public function sendContent()
    {
        echo $this->content ;
    }

    public function send()
    {
        $this->sendContent();
    }
}