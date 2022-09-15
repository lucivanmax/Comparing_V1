<?php

class Application_Form_Video extends Zend_Form
{

	 public function init()
	    {
	           
	    	$this->setName('video');
	    	
	    	$id = new Zend_Form_Element_Hidden('id');
	    		$id->addFilter('Int');
														
	    		$tipo = new Zend_Form_Element_Select('tipo');
	    		$tipo->setLabel('Tipo')
	    		->setRequired(true)
	    		->addFilter('StripTags')
	    		->addFilter('StringTrim')
	    		->addValidator('NotEmpty')
	    		->setMultiOptions( array(
					'' => 'SELECIONE',
					'PROGRAMA' => 'PROGRAMA',
					'COMERCIAL' => 'COMERCIAL',
					'MATERIA' => 'MATERIA', 
					'PECA' => 'PECA',
	    			'PROPOSTAS' => 'PROPOSTAS',
					'DEPOIMENTO'=> 'DEPOIMENTO',
					'CLIP'=> 'CLIP',
					'VINHETA'=> 'VINHETA',
					'RADIO'=> 'RADIO',
					'INTERNET'=> 'INTERNET',
					'IMPRESSO' => 'IMPRESSO',
					'DIVERSOS' => 'DIVERSOS'))
	    		->setAttrib("class", "input-medium");
	    	
	    
			    		$titulo = new Zend_Form_Element_Text('titulo');
			    		$titulo->setLabel('Título')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->setAttrib("class", "input-large");
			    					    	
			    		
			    		$duracao = new Zend_Form_Element_Text('duracao');
			    		$duracao->setLabel('Duração')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->addValidator('stringLength', false, array(5, 5))
			    		->setAttrib("class", "input-medium");
			    	
				   	    	
			    		$ext_arq = new Zend_Form_Element_Select('ext_arq');
			    		$ext_arq->setLabel('Tipo do Arquivo')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->setMultiOptions( array(
							'video/mp4' => 'MP4',			    				
			    				'audio/mp3' => 'MP3',
			    				'image/png' => 'PNG'))
			    				->setAttrib("class", "input-medium");
			    		
			    		

			    		$nome_arq = new Zend_Form_Element_Text('nome_arq');
			    		$nome_arq->setLabel('Nome do Arquivo (com extensão)')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->setAttrib("class", "input-mediun");
			    		
			    		

			    		$cliente = new Zend_Form_Element_Select('cliente');
			    		$cliente->setLabel('Cliente')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->setMultiOptions( array(
			    				'1' => 'Globo',
			    				'2' => 'SBT',))
			    				->setAttrib("class", "input-medium");
			    		
			    		
			    			
			    		$aprovacao = new Zend_Form_Element_Select('aprovacao');
			    		$aprovacao->setLabel('Aprovação')
			    		->setRequired(true)
			    		->addFilter('StripTags')
			    		->addFilter('StringTrim')
			    		->addValidator('NotEmpty')
			    		->setMultiOptions( array(
							'' => 'SELECIONE',
			    				'Romero' => 'Romero',
			    				'Rubens' => 'Rubens',
			    				'Chico' => 'Chico',
			    				'Weber' =>	'Weber',
			    				'Janderson' => 'Janderson',
			    				'Oseas' => 'Oseas',
			    				'Leandro' => 'Leandro',
			    				'Outros' => 'Outros'))
			    				->setAttrib("class", "input-medium");

			 
	    		
	    	$submit = new Zend_Form_Element_Submit('submit');
	    		$submit->setLabel("Salvar Alterações")
	    		->setAttrib("class", "btn btn_large btn-success")
	    		->setIgnore(true);
												    
	    		
	    	$this->addElements(array($id, $tipo, $titulo, $duracao, $ext_arq, $nome_arq, $cliente, $aprovacao,  $submit));
	    		
	    }


}


