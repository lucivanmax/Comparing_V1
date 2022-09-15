<?php
	
	class Model_Auth

{

	public static function login($login, $senha)

	{

		$dbAdapter = Zend_Db_Table::getDefaultAdapter();

		$authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
		$authAdapter->setTableName('usuario')

		->setIdentityColumn('login')
		->setCredentialColumn('senha')
		->setCredentialTreatment('SHA1(?)');

		$authAdapter->setIdentity($login)
		->setCredential($senha);

		$select = $authAdapter->getDbSelect();
		$select->join( array('p' => 'perfil'), 'p.id = usuario.perfil_id', array('nome_perfil' => 'nome') );

		//Efetua o login
		$auth = Zend_Auth::getInstance();
		$result = $auth->authenticate($authAdapter);

		if ( $result->isValid() ) {


			$info = $authAdapter->getResultRowObject(null, 'senha');

			$usuario = new Model_Usuario();
			$usuario->setFullName( $info->nome_usuario );
			$usuario->setUserName( $info->login );
			$usuario->setRoleId( $info->nome_perfil );
			$usuario->setClientId( $info->clientes_id );

			$storage = $auth->getStorage();
			$storage->write($usuario);

			return true;

		}

		throw new Exception('Login ou senha inválida');

	}

}
