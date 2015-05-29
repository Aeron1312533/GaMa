<?php

class LeagueController extends Gm_Controller_Action {    
    public function tableAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {             
            $db = Zend_Db_Table::getDefaultAdapter();
              
            $stmt = $db->prepare('CALL GetLeagueTable(:param1)');
            $stmt->bindValue(':param1', 1);
            $stmt->execute();
              
            $rows = $stmt->fetchAll();

            $this->_helper->json($rows);
            return;
       }
    }
    
    public function matchesAction() {
        if ($this->getRequest()->isXmlHttpRequest()) {             
            $db = Zend_Db_Table::getDefaultAdapter();
              
            $stmt = $db->prepare('CALL GetLeagueMatches(:param1)');
            $stmt->bindValue(':param1', 1);
            $stmt->execute();
              
            $rows = $stmt->fetchAll();

            $this->_helper->json($rows);
            return;
       }
    }
   
}

