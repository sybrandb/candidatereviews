<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Form;

/**
 * Description of QuestionnaireFormInterface
 *
 * @author sybrandb
 */
use Zend\Form\FormInterface;

interface QuestionnaireFormInterface extends FormInterface {
    //put your code here
    
    public function addCsrfElement($name='tick');
    
    /**
     * Add id element
     */
    public function addIdElement($name = 'id');
        
    /**
     * Add title element
     */
    public function addNameElement($name = 'name');
    
    /**
     * Add teaser element
     */
    public function addDescriptionElement($name = 'description');
    
    /**
     * Add content element
     */
    public function addMaxtimeElement($name = 'maxtime');
    
    public function addScoreElement($name='score');
    
    public function addPassing_scoreElement($name='passing_score');
    
   
    
    /**
     * Add submit element
     */
    public function addSubmitElement($name = 'save', $label = 'Speichern');

}
