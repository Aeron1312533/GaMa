<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap {    
    protected function _initGmLibrary() {
        $loader = Zend_Loader_Autoloader::getInstance();
        $loader->registerNamespace('Gm_');
    }
    
    protected function _initAcl() {         
     /*  if (Zend_Auth::getInstance()->hasIdentity()){
            Zend_Registry::set ('role',
                     Zend_Auth::getInstance()->getStorage()
                                              ->read()
                                              ->role);
        } else {
            Zend_Registry::set('role', 'visitor');
        }

        $acl = new Application_Model_Acl();
        Zend_Registry::set('acl', $acl);*/

    }
    
    protected function _initNavigations() {
        $nav_conf_files = glob(APPLICATION_PATH . '/configs/navigation/' . '*.ini');
        
        foreach($nav_conf_files as $item) {       
            $config = new Zend_Config_Ini($item); 
            $navigation = new Zend_Navigation($config); 
            
            Zend_Registry::set(basename($item, ".ini"), $navigation);
        }
    }
    
    /*protected function _initZFDebug() {
        $autoloader = Zend_Loader_Autoloader::getInstance();
        $autoloader->registerNamespace('ZFDebug');
    
        if ('development' == APPLICATION_ENV) {
            $options = array(
                'plugins' => array('Variables', 
                           'File' => array('base_path' => APPLICATION_PATH),
                           'Html',
                           'Exception',
                           'Variables',
                           'Log')
            );
    
            # Instantiate the database adapter and setup the plugin.
            # Alternatively just add the plugin like above and rely on the autodiscovery feature.
            if ($this->hasPluginResource('db')) {
                $this->bootstrap('db');
                $db = $this->getPluginResource('db')->getDbAdapter();
                $options['plugins']['Database']['adapter'] = $db;
            }

            # Setup the cache plugin
            if ($this->hasPluginResource('cache')) {
                $this->bootstrap('cache');
                $cache = $this-getPluginResource('cache')->getDbAdapter();
                $options['plugins']['Cache']['backend'] = $cache->getBackend();
            }

            // init dumper
            $dumps = Array();
            Zend_Registry::set('dumper', $dumps);
        
            $debug = new ZFDebug_Controller_Plugin_Debug($options);
    
            $this->bootstrap('frontController');
            $frontController = $this->getResource('frontController');
            $frontController->registerPlugin($debug);
        }
    }  */   
}

