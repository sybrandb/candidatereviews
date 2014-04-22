<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Listener;

use Zend\Db\TableGateway\Feature\EventFeature\TableGatewayEvent;
use Zend\EventManager\EventInterface;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\ListenerAggregateInterface;
use Zend\Log\Logger;
use Zend\Log\Writer\Stream;

/**
 * Description of LogListener
 *
 * @author sybrandb
 */
class LogListener implements ListenerAggregateInterface{
    //put your code here
    protected $logger = null;
    protected $listeners = array();
    
    public function __construct($file) {
        $this->logger = new Logger();
        $this->logger->addWriter(New Stream($file));
    }    
        
    public function attach(EventManagerInterface $events) {
      $this->listeners[] = $events->attach('postInitialize', array($this,'logPostInitialize')
              );
     
      $this->listeners[] = $events->attach('postInsert', array($this,'logPostInsert')
              );
      $this->listeners[] = $events->attach('postUpdate', array($this,'logPostUpdate')
              );
   
    }
    
    public function detach(EventManagerInterface $events) {
        foreach ($this->listeners as $index => $listener) {
         if ($events->detach($listener)) {
             unset($this->listeners[$index]);
         }
        }
    }
    
    
    public function logPostInitialize(TableGatewayEvent $e) {
        $this->logger->log(Logger::INFO,
                'TableGateway voor tabel "' . $e->getTarget()->getTable() . '" geinitialiseerd');
               
    }
}
