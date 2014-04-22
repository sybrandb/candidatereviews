<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Entity;

/**
 * Description of QuestionnaireEntity
 *
 * @author sybrandb
 */
class QuestionnaireEntity implements QuestionnaireEntityInterface {
    //put your code here
    
   protected $id;
   
   protected $name;
   
   protected $description;
   
   protected $maxtime;

   protected $score;
   
   protected $passing_score;
   
   protected $created_ts;
   
   protected $created_by;
   
   protected $updated_ts;
   
   protected $updated_by;
   
   public function setId($id) {
       $this->id = $id;
   }
   
   public function getId() {
       return $this->id;
   }
   
   public function setName($name) {
       $this->name = $name;
   }
   
   public function getName() {
       return $this->name;
   }
   
   public function setDescription($description) {
       $this->description = $description;
   }
    
    public function getDescription() {
        return $this->description;
    }
    
    public function setMaxtime($maxtime) {
        $this->maxtime = $maxtime;
    }
    
    public function getMaxtime() {
        return $this->maxtime;
    }
    
    public function setScore($score) {
        $this->score = $score;
    }
    
    public function getScore() {
        return $this->score;
    }
    
    public function setPassing_score($passing_score) {
        $this->passing_score = $passing_score;
    }
    
    public function getPassing_score() {
        return $this->passing_score;
    }
    
    public function setCreated_ts($created_ts) {
        $this->created_ts = $created_ts;
    }
    
    public function getCreated_ts() {
        return $this->created_ts;
    }
    
    public function setCreated_by($created_by) {
        $this->created_by = $created_by;
    }
    
    public function getCreated_by() {
        return $this->created_by;
    }
    
    public function setUpdated_ts($updated_ts) {
        $this->updated_ts = $updated_ts;
    }
    
    public function getUpdated_ts() {
        return $this->updated_ts;
    }
    
    public function setUpdated_by($updated_by) {
        $this->updated_by = $updated_by;
    }
    
    public function getUpdated_by() {
        return $this->updated_by;
    }
    
    public function exchangeArray(array $array)
    {
        foreach ($array as $key => $value) {
            if (empty($value)) {
                continue;
            }
            $method = 'set' . ucfirst($key);
            if (!method_exists($this, $method)) {
                continue;
            }
            $this->$method($value);
        }
    }

    /**
     * Return an array representation of the object
     *
     * @return array
     */
    public function getArrayCopy()
    {
        return array(
            'id'            => $this->getId(),
            'name'          => $this->getName(),
            'description'   => $this->getDescription(),
            'maxtime'       => $this->getMaxtime(),
            'score'         => $this->getScore(),
            'passing_score' => $this->getPassing_score(),
            'created_by'    => $this->getCreated_by(),
            'created_ts'    => $this->getCreated_ts(),
            'updated_by'    => $this->getUpdated_by(),
            'updated_ts'    => $this->getUpdated_ts(),
        );
    
    }
}
