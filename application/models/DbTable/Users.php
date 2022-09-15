<?php

class Application_Model_DbTable_Users extends Zend_Db_Table_Abstract
{

    protected $_name = 'usuario';

     
    
    public function getUser($id)
    {
    	$id= (int)$id;
    	$row = $this->fetchRow('id = ' .$id);
    	if (!$row) {
    		throw new Exception('Não econtrou o $id');
    	}
    	return $row->toArray();
    }
    
    
    public function newUser( $login, $senha, $nome, $permissao, $empresa )
    {
    	
    	$data = array(
    				
    			'login' => $login,
    			'senha' => sha1($senha),
    			'nome_usuario' => $nome,    			
    			'clientes_id' => $empresa,
    			'perfil_id' => $permissao,
    			
    			
    	);
    	$this->insert($data);
    }
    
    
  /*  public function updateUser( $id, $login, $senha, $nome )
    {
    	$data = array(
    			'login' => $login,
    			'senha' => $senha,
    			'nome' => $nome,
    	);
    	$this->update($data, 'id = ' .(int)$id);
    }
    
    */
    
    public function deleteUser($id)
    {
    	$this->delete('id = ' . (int)$id);
    }
    
   
}

