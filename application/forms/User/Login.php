<?php

class Application_Form_User_Login extends Zend_Form {

    public function init() {
        $configFilePath = APPLICATION_PATH . "/forms/User/configs/login.ini";
        $config = new Zend_Config_Ini($configFilePath);
        
        $this->setConfig($config);
        
                $this->setDecorators(array(array('ViewScript', array(
            'viewScript' => '_form.phtml'
))));
                

        $this->addAttribs(array('novalidate' => 'novalidate', 'class' => 'form-horizontal'));
        $this->getElement('username')->setRequired(true)->setErrorMessages(array(
            'isEmpty'=>'Prosím, zadajte prihlasovacie meno'
        ));
        $this->getElement('username')->setAttrib('ng-minlength',5);
        $this->getElement('username')->setAttrib('ng-model','loginform.username');
        $this->getElement('username')->setAttrib('ng-required','true');
        $this->getElement('username')->setAttrib('class','col-lg-2');
        
        $this->getElement('password')->setAttrib('class','col-lg-2');
        $this->getElement('password')->setAttrib('ng-model','loginform.password');
        $this->getElement('password')->setAttrib('required','required');
        $this->getElement('password')->setRequired(true)->setErrorMessages(array(
            'isEmpty'=>'Prosím, zadajte heslo'
        ));

                $this->getElement('signin')->setAttrib('type', 'submit');
                $this->getElement('signin')->setAttrib('ng-disabled', 'form_login.$invalid');
                $this->getElement('signin')->setAttrib('content', 'prihlasit');
    }

}

