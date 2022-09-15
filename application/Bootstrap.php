<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
	
	protected function _initAutoload()
	{
		$autoloader = new Zend_Application_Module_Autoloader(array(
				'basePath' => APPLICATION_PATH,
				'namespace' => ''
		));
		return $autoloader;
	}
	protected function _initAcl()
	{
		$aclSetup = new Aplicacao_Acl_Setup();
	}
	
		

}

