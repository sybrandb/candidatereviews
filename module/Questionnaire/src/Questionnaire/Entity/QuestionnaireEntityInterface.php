<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Entity;

/**
 * Description of QuestionnaireEntityInterface
 *
 * @author sybrandb
 */


use Zend\Stdlib\ArraySerializableInterface;

interface QuestionnaireEntityInterface extends ArraySerializableInterface {
    
    
    //put your code here
    
    public function setId($id);
    
    public function getId();
    
    public function setName($name);
    
    public function getName();
    
    public function setDescription($description);
    
    public function getDescription();
    
    public function setMaxtime($maxtime);
    
    public function getMaxtime();
    
    public function setScore($score);
    
    public function getScore();
    
    public function setPassing_score($passing_score);
    
    public function getPassing_score();
    
    public function setCreated_ts($created_ts);
    
    public function getCreated_ts();
    
    public function setCreated_by($created_by);
    
    public function getCreated_by();
    
    public function setUpdated_ts($updated_ts);
    
    public function getUpdated_ts();
    
    public function setUpdated_by($updated_by);
    
    public function getUpdated_by();
    
    
    
    
    
}
