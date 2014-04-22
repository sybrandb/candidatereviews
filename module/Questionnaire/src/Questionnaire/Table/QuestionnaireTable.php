<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Table;

/**
 * Description of QuestionnaireTable
 *
 * @author sybrandb
 */

use Questionnaire\Entity\QuestionnaireEntityInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\ResultSet\ResultSet;
use Zend\Db\TableGateway\TableGateway;

class QuestionnaireTable extends TableGateway implements QuestionnaireTableInterface{
    //put your code here
    
    public function __construct(Adapter $adapter, QuestionnaireEntityInterface $entity)
    {
        
        $resultSet = new ResultSet();
        $resultSet->setArrayObjectPrototype($entity);
        
        parent::__construct('questionnaire', $adapter, null, $resultSet);
    }
    
     public function fetchSingleById($id)
    {
        $select = $this->getSql()->select();
        $select->where->equalTo('id', $id);
        
        return $this->selectWith($select)->current();
    }
    
        public function fetchSingleByName($name)
    {
        $select = $this->getSql()->select();
        $select->where->equalTo('name', $name);
        
        return $this->selectWith($select)->current();
    }
}
