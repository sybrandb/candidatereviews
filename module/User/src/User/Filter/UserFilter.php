<?php
/**
 * ZF2 Buch Kapitel 17
 * 
 * Das Buch "Zend Framework 2 - Das Praxisbuch"
 * von Ralf Eggert ist im Galileo-Computing Verlag erschienen. 
 * ISBN 978-3-8362-2610-3
 * 
 * @package    User
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Alle Listings sind urheberrechtlich geschützt!
 * @link       http://www.zendframeworkbuch.de/ und http://www.galileocomputing.de/3460
 */

/**
 * namespace definition and usage
 */
namespace User\Filter;

use Zend\InputFilter\InputFilter;


/**
 * User filter
 * 
 * @package    User
 */
class UserFilter extends InputFilter
{
    /**
     * Build filter
     */
    public function __construct()
    {
        $this->add(array(
            'name'       => 'role',
            'required'   => true,
            'validators' => array(
                array(
                    'name'    => 'InArray',
                    'options' => array(
                        'haystack' => array('guest', 'candidate', 'staff', 'admin'),
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'email',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'EmailAddress',
                    'options' => array(
                        'useDomainCheck' => true,
                        'useMxCheck' => true,
                        'message'        => 'Geen geldig e-mail adres',
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'pass',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                        'min'      => 5, 
                        'max'      => 128,
                        'message'  => 'Passwort muss mindestens 5 Zeichen lang sein',
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name'       => 'firstname',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                        'min'      => 1, 
                        'max'      => 64,
                    ),
                ),
            ),
        ));
        
       
         $this->add(array(
            'name'       => 'lastname',
            'required'   => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8', 
                        'min'      => 1, 
                        'max'      => 64,
                    ),
                ),
            ),
        ));
         
     
             $this->add(array(
             'name' => 'bsn',
             'required' => true,
            'filters'    => array(
                array('name' => 'StringTrim'),
                array('name' => 'StripTags'),
            ),
            'validators' => array(
                 array('name' => '\User\Validator\CheckBSN',
                ),
            )
        ));
             $datemin = new \DateTime();
             $datemin->sub(\DateInterval::createFromDateString('65 years'));

             $datemax = new \DateTime();
             $datemax->sub(\DateInterval::createFromDateString('18 years'));

             $this->add(array(
                'name' => 'birthdate',
                'required' => true,
                'filters' => array (
                    array('name' => 'StringTrim'),
                    array('name' => 'StripTags')
                ),
                 'validators' => array(
                     array('name' => 'between',
                     'options' => array(    
                     'min' => $datemin->format('Y-m-d'),
                     'max' => $datemax->format('Y-m-d'))
                         )
                 )
             ));
             
    }
}
