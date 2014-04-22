<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Table;

/**
 * Description of QuestionnaireTableInterface
 *
 * @author sybrandb
 */

use Questionnaire\Entity\QuestionnaireEntityInterface;
use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\TableGatewayInterface;

interface QuestionnaireTableInterface extends TableGatewayInterface {
    //put your code here
    
    public function __construct(Adapter $adapter, QuestionnaireEntityInterface $entity);
    
    
    public function fetchSingleById($id);
    
    public function fetchSingleByName($name);
 
}
