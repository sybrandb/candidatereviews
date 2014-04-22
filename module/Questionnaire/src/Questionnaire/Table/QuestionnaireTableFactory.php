<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Table;

/**
 * Description of QuestionnaireTableFactory
 *
 * @author sybrandb
 */
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * User table factory
 * 
 * Generates the User table object
 * 
 * @package    User
 */
class QuestionnaireTableFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $adapter = $serviceLocator->get('Zend\Db\Adapter\Adapter');
        $entity  = $serviceLocator->get('Questionnaire\Entity\Questionnaire');
        $table   = new QuestionnaireTable($adapter, $entity);
        return $table;
    }
}