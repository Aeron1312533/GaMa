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
class Application_Model_Business_Pattern_Strategy_Match_Context {
    //strategies
    const LEAGUE_MATCH = 1;
    const FRIENDLY_MATCH = 2;
    
    private $strategy = NULL;
    
    public function __construct($strategy) {
        switch ($strategy) {
            case self::LEAGUE_MATCH: 
                $this->strategy = new Application_Model_Business_Pattern_Strategy_Match_League();
                break;
            case self::FRIENDLY_MATCH: 
                $this->strategy = new Application_Model_Business_Pattern_Strategy_Match_Friendly();
                break;
            default: 
                break;
        }
    }
    public function add($data) {
        return $this->strategy->add($data);
    }
}
