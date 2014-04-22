<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Form;

/**
 * Description of QuestionnaireForm
 *
 * @author sybrandb
 */
use Zend\Form\Form;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Csrf;
use Zend\Form\Element\Number;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Text;
use Zend\Form\Element\Textarea;
use Zend\Form\Element\Time;


class QuestionnaireForm extends Form implements QuestionnaireFormInterface {
    //put your code here
    
    public function addCsrfElement($name = 'tick') {
        $element = new Csrf($name);
        $this->add($element);
    }
       public function addIdElement($name = 'id')
    {
        $element = new Hidden($name);
        $this->add($element);
    
    }
    
    public function addDescriptionElement($name = 'description') {
        $element = new Textarea($name);
        $element->label = 'Description';
        $this->add($element);
    }
    
    public function addMaxtimeElement($name = 'maxtime') {
        $element = new Time($name);
        $element->label = 'Maximum Time';
        $this->add($element);
        
    }
    public function addScoreElement($name = 'score') {
        $element = new Number($name);
        $element->label = 'Maximum Score';
        $this->add($element);
    }
    
    public function addPassing_scoreElement($name = 'passing_score') {
        $element = new Number($name);
        $element->label = 'Required Score to pass';
        $this->add($element);
    }
     public function addSubmitElement($name = 'save', $label = 'Opslaan')
    {
        $element = new Submit($name);
        $element->setValue($label);
        $element->setAttribute('class', 'btn');
        $this->add($element);
    }
}
