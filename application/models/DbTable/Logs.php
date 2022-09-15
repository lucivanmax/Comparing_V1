<?php

class Application_Model_DbTable_Logs extends Zend_Db_Table_Abstract
{

    protected $_name = 'LogUsuarios';
    
    
    public function getLogs($id)
    {
    	$id= (int)$id;
    	$row = $this->fetchRow('id = ' .$id);
    	if (!$row) {
    		throw new Exception('Não econtrou o $id');
    	}
    	return $row->toArray();
    }
    


}

