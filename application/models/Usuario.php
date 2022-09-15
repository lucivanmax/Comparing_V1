<?php
	
	class Model_Usuario implements Zend_Acl_Role_Interface
	
	{
	
		private $_userName;
	
		private $_roleId;
	
		private $_fullName;
		
		private $_clientId;
		

	
		
	
		public function getUserName()
	
		{
	
			return $this->_userName;
	
		}
	
		
	
		public function setUserName($userName)
	
		{
	
			$this->_userName = (string) $userName;
	
		}
	
		
	
		public function getFullName()
	
		{
	
			return $this->_fullName;
	
		}
	
		
	
		public function setFullName($fullName)
	
		{
	
			$this->_fullName = (string) $fullName;
	
		}
	
		/**
	
		 *
	
		 */
	
		public function getRoleId()
	
		{
	
			return $this->_roleId;
	
		}
	
		
	
		public function setRoleId($roleId)
	
		{
	
			$this->_roleId = (string) $roleId;
	
		}
		
		/**
		
		*
		
		*/
		
		public function getClientId()
		
		{
		
			return $this->_clientId;
		
		}
		
		
		
		public function setClientId($clientId)
		
		{
		
			$this->_clientId = (string) $clientId;
		
		}
		
	
	}