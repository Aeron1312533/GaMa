<?php


class Gm_Controller_Action extends Zend_Controller_Action {
    
    protected $services = array();
    
    public function _construct() {
        parent::__construct();
        
    }
    
    public function preDispatch() {
       /* //get request information
        $resource = $this->getRequest()->getControllerName ();
        $action = $this->getRequest()->getActionName ();
        
        //check permissions
        $acl = Zend_Registry::get('acl');
        if (!$acl->isAllowed(Zend_Registry::get('role'), $resource, $action)){
            $flashMessenger = $this->_helper->getHelper('MyFlashMessenger');
            $flashMessenger->addMessage('Pre danú akciu nemáte oprávnenie.',
                    null, Strateg_MyFlashMessenger_Message::DANGER);
            $request = $this->getRequest();
            $this->redirect($request->getHeader('referer'));
        }*/
        
        //init navigation
        $this->view->navigation_main = Zend_Registry::get('navigation-main');
    }
    
    public function init() {
        parent::init();
       
        $action = $this->getRequest()->getActionName();
        $isAjax = $this->getRequest()->isXmlHttpRequest();
        $isPost = $this->getRequest()->isPost();
        
        if (in_array($action, $this->services)
            && !$isAjax
            && !$isPost) {
            return;
        }
    }
    
    public function setServices($services) {
        $this->services = $services;
    }
    
    public function getServices() {
        return $this->services;
    }
    
}