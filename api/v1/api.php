<?php
require_once 'API.class.php';
class MyAPI extends API
{
    protected $User;

    public function __construct($request, $origin) {
        parent::__construct($request);

	/*
        // Abstracted out for example
        $APIKey = new Models\APIKey();
        $User = new Models\User();

        if (!array_key_exists('apiKey', $this->request)) {
            throw new Exception('No API Key provided');
        } else if (!$APIKey->verifyKey($this->request['apiKey'], $origin)) {
            throw new Exception('Invalid API Key');
        } else if (array_key_exists('token', $this->request) &&
             !$User->get('token', $this->request['token'])) {

            throw new Exception('Invalid User Token');
        }

        $this->User = $User;
	*/
    }

    protected function temperature() {
       if ($this->method == 'GET') {
           $file = fopen("/var/www/html/index.html","r");

           $data = array();

           while(! feof($file))
           {
              $str = fgets($file);
              if($str != false) {
                 $str = substr($str, 0, -8);
		 $strs = explode(" ", $str);
                 array_push($data, array($strs[0], $strs[1]));
              }
           }

           fclose($file);

           return array('data' => $data, 'status' => 200);
       } else {
           return array('status' => 405);
       }
    }
}

// Requests from the same server don't have a HTTP_ORIGIN header
if (!array_key_exists('HTTP_ORIGIN', $_SERVER)) {
    $_SERVER['HTTP_ORIGIN'] = $_SERVER['SERVER_NAME'];
}

try {
    $API = new MyAPI($_REQUEST['request'], $_SERVER['HTTP_ORIGIN']);
    echo $API->processAPI();
} catch (Exception $e) {
    header("HTTP/1.1 " . 500 . " " . "Internal Server Error");

    echo json_encode(array('error' => $e->getMessage(), 'status' => 500));
}
?>
