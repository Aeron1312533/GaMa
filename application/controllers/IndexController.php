<?php

class IndexController extends Zend_Controller_Action
{

    public function indexAction() {
        $this->redirect('/dashboard/show');
    }
}
