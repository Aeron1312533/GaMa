<?php

class MatchController extends Gm_Controller_Action {
    public function initAction() {
        $this->setServices(array(
            'addLeagueMatch',
            'addFriendlyMatch'
        ));
        
        parent::init();
    }
    
    public function addLeagueMatchAction() {
        $this->_helper->json(
            Application_Model_Service_Match::addLeagueMatch($this->getRequest()->getPost())
        );
    }
    
    public function addFriendlyMatchAction() {
        $this->_helper->json(
            Application_Model_Service_Match::addFriendlyMatch($this->getRequest()->getPost())
        );
    }
    
    public function showAction() {
        $form = new Application_Form_Match_Add();
        $this->view->form = $form;  
              
        $this->view->form->populate(array());
    }
   
}

