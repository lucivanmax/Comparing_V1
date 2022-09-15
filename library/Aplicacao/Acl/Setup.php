<?php

class Aplicacao_Acl_Setup

{

	/**

	 * @var Zend_Acl

	 */

	protected $_acl;



	public function __construct()

	{

		$this->_acl = new Zend_Acl();

		$this->_initialize();

	}



	protected function _initialize()

	{

		$this->_setupRoles();

		$this->_setupResources();

		$this->_setupPrivileges();

		$this->_saveAcl();

	}



	protected function _setupRoles()

	{

		$this->_acl->addRole( new Zend_Acl_Role('guest') );
		
		$this->_acl->addRole( new Zend_Acl_Role('comum'), 'guest' );
		
		$this->_acl->addRole( new Zend_Acl_Role('gestor'), 'comum' );
		
		$this->_acl->addRole( new Zend_Acl_Role('admin'), 'gestor' );

	}



	protected function _setupResources()

	{

		$this->_acl->addResource( new Zend_Acl_Resource('auth') );

		$this->_acl->addResource( new Zend_Acl_Resource('index') );

		$this->_acl->addResource( new Zend_Acl_Resource('gestor') );
	
		$this->_acl->addResource( new Zend_Acl_Resource('admin') );

	}



	protected function _setupPrivileges()

	{


		$this->_acl->allow( 'comum', 'index', array('init', 'index','relatorio', 'multimidia') )

		->allow( 'comum', 'auth', 'logout' );
		

		$this->_acl->allow( 'gestor', 'gestor', array('init', 'index', 'listvideo',
		
				'newvideo', 'editvideo', 'deletevideo' , 'multimidia' ) )
		
				->allow( 'admin', 'auth', 'logout' );
		
	
		$this->_acl->allow( 'admin', 'admin', array('init', 'index', 'listvideo',
				
		 					'newvideo', 'editvideo', 'deletevideo' , 'listuser',
				
		 					'newuser',  'deleteuser',  'multimidia', 'historicodelogs' ) )
		
		->allow( 'admin', 'auth', 'logout' );

	}



	protected function _saveAcl()

	{

		$registry = Zend_Registry::getInstance();

		$registry->set('acl', $this->_acl);

	}

}
