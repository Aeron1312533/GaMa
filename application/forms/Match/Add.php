<?php

class Application_Form_Match_Add extends Zend_Form {

    public function init() {
        parent::init();
        $configFilePath = APPLICATION_PATH . "/forms/Match/configs/AddLeagueMatch.ini";
        $config = new Zend_Config_Ini($configFilePath);       
        $this->setConfig($config);       
        $this->setDecorators(array(array('ViewScript', array(
            'viewScript' => 'template/form/AddLeagueMatch.phtml'
        ))));
                

        $this->addAttribs(array('novalidate' => 'novalidate', 'class' => 'form-horizontal'));
        
        $this->getElement('isfriendly')->setAttrib('ng-model','addleaguematchform.isfriendly');
        
        $this->getElement('player1score')->setAttrib('min',0);
        $this->getElement('player1score')->setAttrib('ng-model','addleaguematchform.player1score');
        $this->getElement('player1score')->setAttrib('ng-required','true');
        $this->getElement('player1score')->setAttrib('class','form-control');
        
        $this->getElement('player2score')->setAttrib('min',0);
        $this->getElement('player2score')->setAttrib('ng-model','addleaguematchform.player2score');
        $this->getElement('player2score')->setAttrib('ng-required','true');
        $this->getElement('player2score')->setAttrib('class','form-control');
      
        $this->getElement('addleaguematch')->setAttrib('type', 'submit');
        $this->getElement('addleaguematch')->setAttrib('ng-disabled', 'isDisabled(form_add_league_match)');
        $this->getElement('addleaguematch')->setAttrib('content', 'Add');
        
        $this->getElement('resetleaguematch')->setAttrib('ng-click', 'reset(addleaguematchform)');
        $this->getElement('resetleaguematch')->setAttrib('content', 'Reset');
         
        $this->initPlayer1Element();
        $this->initPlayer2Element();
        $this->initNoteElement();
    }

    public function initPlayer1Element() {
        $element = $this->getElement('player1');
        $element->setAttrib('ng-model','addleaguematchform.player1');
        $element->setAttrib('ng-required','true');
        $element->setAttrib('class','form-control');
        $element->setAttrib('different','Player 2');
        
        $players = new Application_Model_DbTable_Player();
            
        $result = $players->fetchAll(Zend_Db::FETCH_ASSOC);
            
        foreach ($result as $row) {
            $element->addMultiOption($row['id_player'] , $row['nickname']);
        }
    }
    
    public function initPlayer2Element() {
        $element = $this->getElement('player2');
        $element->setAttrib('ng-model','addleaguematchform.player2');
        $element->setAttrib('ng-required','true');
        $element->setAttrib('class','form-control');
        $element->setAttrib('different','Player 1');
        
        $players = new Application_Model_DbTable_Player();
            
        $result = $players->fetchAll(Zend_Db::FETCH_ASSOC);
            
        foreach ($result as $row) {
            $element->addMultiOption($row['id_player'], $row['nickname']);
        }
    }
    
    public function initNoteElement() {
        $element = $this->getElement('note');
        
        $element
            ->setAttrib('ng-model','addleaguematchform.note')
            ->setAttrib('cols', '40')
            ->setAttrib('rows', '4');
    }
}

