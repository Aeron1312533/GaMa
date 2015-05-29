<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of newPHPClass
 *
 * @author Aeron
 */
class Application_Model_Business_Pattern_Strategy_Match_Friendly {
    public function add($data) {
        $db = Zend_Db_Table::getDefaultAdapter();
              
        $stmt = $db->prepare('CALL AddFriendlyMatch(:param1, :param2, :param3, :param4, :param5)');
        $stmt->bindValue(':param1', $data['player1']);
        $stmt->bindValue(':param2', $data['player2']);
        $stmt->bindValue(':param3', $data['player1score']);
        $stmt->bindValue(':param4', $data['player2score']);
        $stmt->bindValue(':param5', isset($data['note']) ? $data['note'] : '');
        $stmt->execute();
    }
}
