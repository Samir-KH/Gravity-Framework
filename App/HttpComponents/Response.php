<?PHP 
//header("HTTP/1.1 404 Not Found");
/**
 *
 * This class is a part of httpComponents
 * 
 */
namespace App\HttpComponents;

class Response{

    private $content;
    private $headers_bag;
    public $status;


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

    public function sendHeaders()
    {
        if (isset($this->headers_bag)){
            foreach($this->headers_bag as $header_name => $value)
            header($header_name.": ".$value);
        }

        header($this->status);
    }

    public function sendContent()
    {
        echo $this->content ;
    }

    public function send()
    {
        $this->sendHeaders();
        $this->sendContent();
        
    }
}