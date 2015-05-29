<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of user
 *
 * @author peter.pekarovic
 */
class Application_Model_Service_Match {
    public static function addLeagueMatch($data) {
        $match = new Application_Model_Business_Pattern_Strategy_Match_Context(
            Application_Model_Business_Pattern_Strategy_Match_Context::LEAGUE_MATCH
        );
        
        try {
            $match->add($data);
        } catch (Exception $e) {
            throw $e;
        }
        
       return array(); 
    }
    
    public static function addFriendlyMatch($data) {
        $match = new Application_Model_Business_Pattern_Strategy_Match_Context(
            Application_Model_Business_Pattern_Strategy_Match_Context::FRIENDLY_MATCH
        );
        
        try {
            $match->add($data);
        } catch (Exception $e) {
            throw $e;
        }
    
        return array();
    }
   
}
