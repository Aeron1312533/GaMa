<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Dumper
 *
 * @author Aeron
 */
class ZFDebug_Dumper {
    
    const _index = 'dumper';
    
    public static function dump($variable, $label = NULL) {
        //get registry
        if (Zend_Registry::isRegistered(self::_index)) {
            $dumps = Zend_Registry::get(self::_index);       
            $dumps[] = Array(
                'label' => $label,
                'value' => $variable
            );
            Zend_Registry::set(self::_index, $dumps);
        }
    }
}
