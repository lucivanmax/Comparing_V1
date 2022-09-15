<?php

class GestorController extends Zend_Controller_Action
{

    public function init()
    {
        
            if ( !Zend_Auth::getInstance()->hasIdentity() ) {
                return $this->_helper->redirector->goToRoute( array('controller' => 'auth'), null, true);
            } 
    }

    public function indexAction()
    {
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
		
    }
    
    public function listvideoAction()
    {
    	$videos = new Application_Model_DbTable_Videos();
    
    	$select = $videos->select()
    	->order('id DESC');
    	$this->view->videos = $videos->fetchAll($select);
    }

  public function newvideoAction()
    {
      	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	
    	
    	$form = new Application_Form_Video();
    	 
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {
    			$id = (int)$form->getValue('id');
    			 
    			$tipo = $form->getValue('tipo');
    			$titulo = $form->getValue('titulo');
    	
    			$data= Zend_Date::now()->toString ('dd-MM | HH: mm ');
    			
    			$duracao = $form->getValue('duracao');
    			$ext_arq = $form->getValue('ext_arq');
    			$nome_arq = $form->getValue('nome_arq');
    			$aprovacao = $form->getValue('aprovacao');
    	
    			$videos = new Application_Model_DbTable_Videos();

			$auth = Zend_Auth::getInstance();
    			$identity = $auth->getIdentity();
    			$user = $identity->getFullName();
    			 
    			$videos->newVideo($tipo, $titulo, $data, $duracao, $ext_arq, $nome_arq, $aprovacao, $user);
    			 
    			$this->_helper->redirector('listvideo');
    		}else {
    			$form->populate($formData);
    		}
    	}else {
    		$id = $this->_getParam('id', 0);
    		if ($id > 0) {
    			$videos = new Application_Model_DbTable_Videos();
    			$form->populate($videos->getVideo($id));
    			 
    		}
    	}
    	    	
    }
 

    public function editvideoAction()
    {
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	
    	
    	$form = new Application_Form_Video();
    	 
    	$this->view->form = $form;
    	
    	if ($this->getRequest()->isPost()) {
    		$formData = $this->getRequest()->getPost();
    		if ($form->isValid($formData)) {    	
    			$id = (int)$form->getValue('id');
    			$tipo = $form->getValue('tipo');
    			$titulo = $form->getValue('titulo');    	
    			$data= Zend_Date::now()->toString ('dd-MM | HH: mm ');
    			$duracao = $form->getValue('duracao');
    			$ext_arq = $form->getValue('ext_arq');
    			$nome_arq = $form->getValue('nome_arq');
    			$aprovacao = $form->getValue('aprovacao');
    			 
    			$videos = new Application_Model_DbTable_Videos();
			
			$auth = Zend_Auth::getInstance();
    			$identity = $auth->getIdentity();
    			$user = $identity->getFullName();

    			$videos->updateVideo($id, $tipo, $titulo, $data, $duracao, $ext_arq, $nome_arq, $aprovacao, $user);
    			$this->_helper->redirector('listvideo');
    		}else {
    			$form->populate($formData);
    		}
    	}else {
    		$id = $this->_getParam('id', 0);
    		if ($id > 0) {
    			$videos = new Application_Model_DbTable_Videos();
    			$form->populate($videos->getVideo($id));
    		}
    	}
    	    	
    }

    public function deletevideoAction()
    {
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    	 
    	if ($this->getRequest()->isPost()) {
    		$del = $this->getRequest()->getPost('del');
    		if ($del == 'Excluir') {
    			$id = $this->getRequest()->getPost('id');
    			$videos = new Application_Model_DbTable_Videos();
    			$videos->deleteVideo($id);
    		}
    		$this->_helper->redirector('listvideo');
    	}else{
    		$id = $this->getParam('id', 0);
    		$videos = new Application_Model_DbTable_Videos();
    		$this->view->video = $videos->getVideo($id);
    	}
    }
    
   

    public function multimidiaAction()
    {
    
    	$usuario = Zend_Auth::getInstance()->getIdentity();
    	$this->view->usuario = $usuario;
    
    	$id = $this->_getParam('id', 0);
    	if ($id > 0) {
    		$videos = new Application_Model_DbTable_Videos();
    		$this->video = $videos->getVideo($id);
    
    		$type = $this->video['ext_arq'];
    		$down_name = $this->video['nome_arq'];
    		 
    		$file = '/home/xxx/xxxx/xxxxx/application/arquivos/'.$down_name;
    		$fp = @fopen($file, 'rb');
    		 
    		$size   = filesize($file); // File size
    		$length = $size;           // Content length
    		$start  = 0;               // Start byte
    		$end    = $size - 1;       // End byte
    		 
    		header('Content-type:' .$type);
    		header("Accept-Ranges: 0-$length");
    		if (isset($_SERVER['HTTP_RANGE'])) {
    			 
    			$c_start = $start;
    			$c_end   = $end;
    			 
    			list(, $range) = explode('=', $_SERVER['HTTP_RANGE'], 2);
    			if (strpos($range, ',') !== false) {
    				header('HTTP/1.1 416 Requested Range Not Satisfiable');
    				header("Content-Range: bytes $start-$end/$size");
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

















