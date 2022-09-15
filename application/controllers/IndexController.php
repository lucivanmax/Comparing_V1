<?php

class IndexController extends Zend_Controller_Action
{

    public function init()
    {
           	
    		if ( !Zend_Auth::getInstance()->hasIdentity() ) {
    			return $this->_helper->redirector->goToRoute( array('controller' => 'auth'), null, true);
    		}
    }

    public function indexAction()
    {
          
     	
    	$auth = Zend_Auth::getInstance();
    	$identity = $auth->getIdentity();
    	 
    	// Get nome_usuario
    	$user = $identity->getFullName();
    	
    	// Get Empresa Relacionada ao Arquivo 
    	$cliente = $identity->getClientId();
    	
    	// Get nome_perfil
    	$usuario = $identity->getRoleId();
    	 

    	$this->view->usuario = $user;
    	
 	
		$videos = new Application_Model_DbTable_Videos();
	
		$select = $videos->select()
				->order('id DESC')
				->where('clientes_id =? ', $cliente);
		$this->view->videos = $videos->fetchAll($select);  
    }
    
    public function multimidiaAction()
    {


    	 
    		$id = $this->_getParam('id', 0);
    		if ($id > 0) {
    			$videos = new Application_Model_DbTable_Videos();
    		$this->contato = $videos->getVideo($id);
    		
    	
    	$type = $this->video['ext_arq'];
    	
    	$down_name = $this->video['nome_arq'];

		$type = $this->video['ext_arq'];

    		$down_name = $this->video['nome_arq'];

    		
    			$file = '/home/arquivos/'.$down_name;
    	
    	$fp = @fopen($file, 'rb');
    	
    	$size   = filesize($file); // File size
    	$length = $size;           // Content length
    	$start  = 0;               // Start byte
    	$end    = $size - 1;       // End byte
    	
    	header('Content-type:' .$type);
    	header("Accept-Ranges: 0-$length");
		header('Content-Disposition: filename='.$down_name);
		header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
		header("Cache-Control: no-cache, must-revalidate");
		header('Pragma: no-cache');


    	if (isset($_SERVER['HTTP_RANGE'])) {
    	
    		$c_start = $start;
    		$c_end   = $end;
    	
    		list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    		if (strpos($range, ',') !== false) {
    			header('HTTP/1.1 416 Requested Range Not Satisfiable');
    			header("Content-Range: bytes $start-$end/$size");
					header('Content-Disposition: filename='.$down_name);
    			exit;
    		}
    		if ($range == '-') {
    			$c_start = $size - substr($range, 1);
    		}else{
    			$range  = explode('-', $range);
    			$c_start = $range[0];
    			$c_end   = (isset($range[1]) && is_numeric($range[1])) ? $range[1] : $size;
    		}
    		$c_end = ($c_end > $end) ? $end : $c_end;
    		if ($c_start > $c_end || $c_start > $size - 1 || $c_end >= $size) {
    			header('HTTP/1.1 416 Requested Range Not Satisfiable');
    			header("Content-Range: bytes $start-$end/$size");
			//teste para evitar o download no S4
				header('Content-Disposition: filename='.$down_name);
    			exit;
    		}
    		$start  = $c_start;
    		$end    = $c_end;
    		$length = $end - $start + 1;
    		fseek($fp, $start);
    		header('HTTP/1.1 206 Partial Content');
    	}
    	header("Content-Range: bytes $start-$end/$size");
    	header("Content-Length: ".$length);
		//teste para evitar o download no S4
			header('Content-Disposition: filename='.$down_name);
    	
    	
    	$buffer = 1024 * 8;
    	while(!feof($fp) && ($p = ftell($fp)) <= $end) {
    	
    		if ($p + $buffer > $end) {
    			$buffer = $end - $p + 1;
    		}
    		set_time_limit(0);
    		echo fread($fp, $buffer);
    		flush();
    	}
    	
    	fclose($fp);
    	exit();
    	
    	
    		}

 
    }

}













