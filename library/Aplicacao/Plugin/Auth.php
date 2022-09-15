<?php

class Aplicacao_Plugin_Auth extends Zend_Controller_Plugin_Abstract

{

    /**
     * @var Zend_Auth
     */

    protected $_auth = null;

    /**
     * @var Zend_Acl
     */

    protected $_acl = null;

    /**
     * @var array
     */

    protected $_notLoggedRoute = array(

        'controller' => 'auth',

        'action'     => 'login',

        'module'     => 'default'

    );

    /**
     * @var array
     */

    protected $_forbiddenRoute = array(

        'controller' => 'error',

        'action'     => 'forbidden',

        'module'     => 'default'

    );



    public function __construct()

    {

        $this->_auth = Zend_Auth::getInstance();
      
        if ($this->_auth->hasIdentity()) { //usuário está conectado 
        // obtém uma instância de Zend_Session_Namespace usado por Zend_Auth 
        $authns = new Zend_Session_Namespace($this->_auth->getStorage()->getNamespace());

        // definir uma expiração no namespace Zend_Auth onde a identidade é mantida 
        $authns->setExpirationSeconds(60 * 30);  // expirar armazenamento auth após 30 min

        $this->_acl = Zend_Registry::get('acl');
        }

    }



    public function preDispatch(Zend_Controller_Request_Abstract $request)

    {

        $controller = "";

        $action     = "";

        $module     = "";

        if ( !$this->_auth->hasIdentity() ) {

            $controller = $this->_notLoggedRoute['controller'];

            $action     = $this->_notLoggedRoute['action'];

            $module     = $this->_notLoggedRoute['module'];

        } else if ( !$this->_isAuthorized($request->getControllerName(),

                    $request->getActionName()) ) {

            $controller = $this->_forbiddenRoute['controller'];

            $action     = $this->_forbiddenRoute['action'];

            $module     = $this->_forbiddenRoute['module'];

        } else {

            $controller = $request->getControllerName();

            $action     = $request->getActionName();

            $module     = $request->getModuleName();

        }

        $request->setControllerName($controller);

        $request->setActionName($action);

        $request->setModuleName($module);

    }



    protected function _isAuthorized($controller, $action)

    {

        $this->_acl = Zend_Registry::get('acl');

        $user = $this->_auth->getIdentity();

        if ( !$this->_acl->has( $controller ) || !$this->_acl->isAllowed( $user, $controller, $action ) )

            return false;

        return true;

    }

}