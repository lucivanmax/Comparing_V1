<?php

    class AuthController extends Zend_Controller_Action
    {

    public function init()
    {
        
    }

    public function indexAction()
    {
        return $this->_helper->redirector('login');
    }

    public function loginAction()
    {

        $this->_flashMessenger = $this->_helper->getHelper('FlashMessenger');
        $this->view->messages = $this->_flashMessenger->getMessages();
        
        $form = new Form_Login();

        if ( $this->getRequest()->isPost() ) {
            $data = $this->getRequest()->getPost();
            
            if ( $form->isValid($data) ) {
                $login = $form->getValue('login');
                $senha = $form->getValue('senha');
            
                // NÃO ESTA SENDO USADO!
                $user = $form->getValue('usuario');
                

                try {
                     
                    Model_Auth::login($login, $senha);                  

                    $auth = Zend_Auth::getInstance();
                
   
                     $params = array ('host'     => 'localhost',
                            'username' => 'XXXX',
                            'password' => 'XXXXX',
                            'dbname'   => 'xxxxxx');

                    $db = Zend_Db::factory('PDO_MYSQL', $params);                    
                    
                    $identity = $auth->getIdentity();
                    
                    $user =  $identity->getRoleId();
                    
                    $nome = $identity->getFullName();
                    $infor_log = $nome.' Login';
                
                    $columnMapping = array('lvl' => 'priority', 'msg' => 'message');
                    $writer = new Zend_Log_Writer_Db($db, 'LogUsuarios', $columnMapping);
                    $logger = new Zend_Log($writer);
                    $logger->info($infor_log); 
                    
                    
                    $admin = "admin";
                    $gestor = "gestor";
                    $comum = "comum";
                    
                    if ($user == $admin) {
                            return $this->_helper->redirector->goToRoute( array('controller' => 'admin'), null, true);
                    }
                    elseif ($user == $gestor){
                        return $this->_helper->redirector->goToRoute( array('controller' => 'gestor'), null, true);
                    }
                    elseif ($user == $comum ){
                        //Redireciona para o Controller protegido
                        return $this->_helper->redirector->goToRoute( array('controller' => 'index'), null, true);
                        
                    }

                
                     
                } catch (Exception $e) {
                     
                    //Dados inválidos
                    $this->_helper->FlashMessenger($e->getMessage());
        
      
                    $params = array ('host'     => 'localhost',
                            'username' => 'XXXX',
                            'password' => 'XXXX',
                            'dbname'   => 'xxxxx');
                    
                    $db = Zend_Db::factory('PDO_MYSQL', $params);                   
                    $columnMapping = array('lvl' => 'priority', 'msg' => 'message');
                    $writer = new Zend_Log_Writer_Db($db, 'LogUsuarios', $columnMapping);
                    $logger = new Zend_Log($writer);
                    $logger->log('Tentou de Logar', 1); 

                    $this->_redirect('/auth/login');
                }
                 
                } else {
                     
                    $form->populate($data);
                }
                 
            }
   
    }

    public function logoutAction()
    {
        $auth = Zend_Auth::getInstance();

                    $params = array ('host'     => 'localhost',
                            'username' => 'XXXX',
                            'password' => 'XXXX',
                            'dbname'   => 'xxxxx');

        $db = Zend_Db::factory('PDO_MYSQL', $params);
        $identity = $auth->getIdentity();
        
        $nome = $identity->getFullName();
        $infor_log = $nome.' Logout';
        $columnMapping = array('lvl' => 'priority', 'msg' => 'message');
        $writer = new Zend_Log_Writer_Db($db, 'LogUsuarios', $columnMapping);
        $logger = new Zend_Log($writer);
        $logger->info($infor_log);

            
        
        $auth->clearIdentity();
        return $this->_helper->redirector('index');
        
        
    }


}





