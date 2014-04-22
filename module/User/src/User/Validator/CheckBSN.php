<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace User\Validator;
use Zend\Validator\AbstractValidator;


/**
 * Description of CheckBSN
 *
 * @author sybrandb
 */
class CheckBSN extends AbstractValidator {
    //put your code here
    const INVALID = 'BSNInvalid';
      protected $messageTemplates = array(
        self::INVALID => "'%value%' is an invalid BSN",
    ); 
    public function isValid($value) {
        $this->setValue($value);
        
        if (!ctype_digit($value)) 
            {
            $this->error(self::INVALID);
            return false;
             }
        if (strlen($value) !== 9) {
            $this->error(self::INVALID);
            return false;
        }     
        $pos = 8;
        $checksum = -1 * $value[$pos];
        $weight = 2;
        for ($pos = 7; $pos >= 0; $pos--) {
            $checksum += $weight++ * $value[$pos];
         }
        
         if (($checksum % 11) !== 0) {
                      $this->error(self::INVALID);
            return false;
             
         }
         
         return true;
    }
}
