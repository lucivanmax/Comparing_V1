<?php

class Application_Model_DbTable_Videos extends Zend_Db_Table_Abstract
{

    protected $_name = 'multimidia';


	public function getVideo($id)
	{
		$id= (int)$id;
		$row = $this->fetchRow('id = ' .$id);
		if (!$row) {
			throw new Exception('Não econtrou o $id');
		}
		return $row->toArray();
	}


	public function newVideo( $tipo, $titulo, $data, $duracao, $ext_arq, $nome_arq, $aprovacao, $cliente,  $user )
	{

		$data = array(				 
				
				'titulo' => $titulo,
				'tipo' => $tipo,
				'data' => $data,
				'duracao' => $duracao,
				'ext_arq' => $ext_arq,
				'nome_arq' => $nome_arq,
				'aprovacao' => $aprovacao,
				'clientes_id'=> $cliente,
				'user' => $user,
			
		);
		$this->insert($data);
	}


	public function updateVideo( $id,  $tipo, $titulo, $data, $duracao, $ext_arq, $nome_arq, $aprovacao, $user )
	{
		$data = array(
				'tipo' => $tipo,
				'titulo' => $titulo,
				'data' => $data,
				'duracao' => $duracao,
				'ext_arq' => $ext_arq,
				'nome_arq' => $nome_arq,
				'aprovacao' => $aprovacao,
				'user' => $user,

		);
		$this->update($data, 'id = ' .(int)$id);
	}



	public function deleteVideo($id)
	{
		$this->delete('id = ' . (int)$id);
	}

	public function pesquisar($id)
	{
		$id= (int)$id;
		$row = $this->fetchRow('id = ' .$id);
		if (!$row) {
			throw new Exception('Não econtrou o $id');
		}
		return $row->toArray();
	}

}


