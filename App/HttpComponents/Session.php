<?PHP 
//header("HTTP/1.1 404 Not Found");
/**
 *
 * This class is a part of httpComponents
 * 
 */
namespace App\HttpComponents;


class Session{


    public function __construct(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_start();
        }
        else if(session_status() !== PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function finish(){
        if(session_status() !== PHP_SESSION_ACTIVE){
            session_destroy();
        }
        else if(session_status() !== PHP_SESSION_NONE) {
            session_destroy();
        }
    }

    public function insert($key, $value){
        $_SESSION[$key] = $value;
    }
    public function insert_array($key, $value){
        if (!isset($_SESSION[$key]))
                $_SESSION[$key] = [];
        $_SESSION[$key][] = $value;
    }
    public function insert_array2($key,$id, $value){
        if (!isset($_SESSION[$key]))
                $_SESSION[$key] = [];
        $_SESSION[$key][$id] = $value;
    }
    public function get($key){
        if (isset($_SESSION[$key]))
            return $_SESSION[$key];
        return null;
    }
    public function isset($key){
        return isset($_SESSION[$key]);
    }
    public function modify($key, $value){
        $_SESSION[$key] = $value;
    }
    public function remove($key, $value){
        if(isset($_SESSION[$key]))
            unset($_SESSION[$key]);
    }


}