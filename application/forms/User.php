<?php

class Application_Form_User extends Zend_Form
{

    public function init()
    {
        
		    	$this->setName('user');
		    	
		    	$id = new Zend_Form_Element_Hidden('id');
		    	$id->addFilter('Int');
		    	
		    
		    	$login = new Zend_Form_Element_Text('login');
		    	$login->setLabel('login: ')
		    	->setRequired(true)
		    	->addFilter('StripTags')
		    	->addFilter('StringTrim')
		    	->addValidator('NotEmpty')
		    	->setAttrib("class", "input-medium");
		    	 
		    	
		    	 
		    	$senha = new Zend_Form_Element_Text('senha');
		    	$senha->setLabel('senha: ')
		    	->setRequired(true)
		    	->addFilter('StripTags')
		    	->addFilter('StringTrim')
		    	->addValidator('NotEmpty')
		    	->setAttrib("class", "input-medium");
		    	
		    	 
		    	$nome = new Zend_Form_Element_Text('nome');
		    	$nome->setLabel('Nome: ')
		    	->setRequired(true)
		    	->addFilter('StripTags')
		    	->addFilter('StringTrim')
		    	->addValidator('NotEmpty')
		    	->setAttrib("class", "input-large");
		    	
		    	$empresa = new Zend_Form_Element_Select('empresa');
		    	$empresa->setLabel('EMPRESA:')
		    	->setRequired(true)
		    	->addFilter('StripTags')
		    	->addFilter('StringTrim')
		    	->addValidator('NotEmpty')
		    	->setMultiOptions( array(
		    			'1' => 'Globo',
		    			'2' => 'SBT',))
		    			->setAttrib("class", "input-medium");
		    	
		    	
		    	$permissao = new Zend_Form_Element_Select('permissao');
		    	$permissao->setLabel('PERMISSÃO:')
		    	->setRequired(true)
		    	->addFilter('StripTags')
		    	->addFilter('StringTrim')
		    	->addValidator('NotEmpty')
		    	->setMultiOptions( array(
		    			'1' => 'ADMIN',
		    			'2' => 'GESTOR',
		    			'3' => 'COMUM',))
		    			->setAttrib("class", "input-medium");
		    			     	 
		    	$submit = new Zend_Form_Element_Submit('submit');
		    	//	$submit->setAttrib('id', 'submitbutton');
		    	$submit->setLabel("Salvar")
		    	->setAttrib("class", "btn btn_large btn-success")
		    	->setIgnore(true);
		    	
		    	 
		    	$this->addElements(array($id, $login, $senha, $nome, $empresa, $permissao, $submit));
    	
    }


}

