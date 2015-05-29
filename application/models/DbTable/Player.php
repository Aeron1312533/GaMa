<?php

class Application_Model_DbTable_Player extends Zend_Db_Table_Abstract
{

    protected $_name = 'player';
    protected $_primary = 'id_player';

    public function getPlayer($id)
    {
        $id = (int)$id;
        $row = $this->fetchRow('id_player = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        return $row->toArray();
    }

    public function addPlayer($data) {
        $this->insert($data);
    }

    public function updatePlayer($id, $data) {
        $this->update($data, 'id_player = '. (int)$id);
    }

    public function deletePlayer($id) {
        $this->delete('id_player = ' . (int)$id);
    }

}