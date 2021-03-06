<?php

class UserController extends Strateg_Controller_Action
{    
    public function indexAction() {
        $this->_helper->redirector('login');
    }
    
    public function loginAction() {
       $form = new Application_Form_User_Login();
       $this->view->form = $form;  
       
       $layout = $this->_helper->layout();
       $layout->setLayout('layout_login');
              
       if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();            

            $result = $formData;
            
            file_put_contents('ett', var_export($result,true));
           /* if ($form->isValid($formData)) {
                $user = new stdClass();
                $user->username = $formData['username'];
                $user->password = $formData['password'];
                
                if ($this->isAuthenticated($user)) {
                    $auth = Zend_Auth::getInstance();
                    $auth->getStorage()->write($user);
                    $result = array('result' => 'ok');
                } else {
                    $result = array('result' => 'error');
                }
              
               /* $flashMessenger = $this->_helper->getHelper('MyFlashMessenger');
                $flashMessenger->addMessage('Neplatné meno alebo heslo.',
                    null, Strateg_MyFlashMessenger_Message::DANGER);
                
                $this->_helper->redirector('login');
                
                $this->_helper->json($result);
            } else {
                $form->populate($formData);
                
               // $result = array('result' => 'errosr');
                $this->_helper->json($result);
            }*/
            $this->_helper->json($result);
        }   
       
    }

    public function logoutAction() {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('login');
    }
    
    private function isAuthenticated(&$user) {
        $config = simplexml_load_file(APPLICATION_PATH . '/configs/users.xml');
        foreach ($config->user as $person) {                  
            if ($user->username == $person->username) {
                if ($person->password == $user->password) {
                    $user->role = (string) $person->role;
                    return true;
                } else {
                    return false;
                }
            }
        }
       
        return false;
    }
}

