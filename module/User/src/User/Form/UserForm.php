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
namespace User\Form;

use Zend\Form\Element\Csrf;
use Zend\Form\Element\Hidden;
use Zend\Form\Element\Password;
use Zend\Form\Element\Text;
use Zend\Form\Element\Radio;
use Zend\Form\Element\Date;
use Zend\Form\Element\DateTime;
use Zend\Form\Element\Select;
use Zend\Form\Element\Submit;
use Zend\Form\Element\Email;
use Zend\Form\Form;

/**
 * User Form
 * 
 * @package    User
 */
class UserForm extends Form implements UserFormInterface
{
    /**
     * Add csrf element
     */
    public function addCsrfElement($name = 'tick')
    {
        $element = new Csrf($name);
        $this->add($element);
    }
        
    /**
     * Add id element
     */
    public function addIdElement($name = 'id')
    {
        $element = new Hidden($name);
        $this->add($element);
    }
        
    /**
     * Add role element
     */
    public function addRoleElement($options = array(), $name = 'role')
    {
        $element = new Select($name);
        $element->setLabel('Gebruikersgroep');
        $element->setValueOptions($options);
        $this->add($element);
    }
    
    /**
     * Add email element
     */
    public function addEmailElement($name = 'email')
    {
        $element = new Email($name);
        $element->setLabel('E-mail adres');
        $this->add($element);
    }
    
    /**
     * Add pass element
     */
    public function addPassElement($name = 'pass')
    {
        $element = new Password($name);
        $element->setLabel('Wachtwoord');
        $this->add($element);
    }
    
    /**
     * Add firstname element
     */
    public function addFirstnameElement($name = 'firstname')
    {
        $element = new Text($name);
        $element->setLabel('Voornaam');
        $this->add($element);
    }
    
    /**
     * Add lastname element
     */
    public function addLastnameElement($name = 'lastname')
    {
        $element = new Text($name);
        $element->setLabel('Achternaam');
        $this->add($element);
    }
    
    
    public function addGenderElement($name='gender') 
    {
        $element = new Radio($name);
        $element->setLabel('Geslacht');
        $element->setValueOptions(array(
             'M' => 'Man',
             'F' => 'Vrouw',
               )
            );
        $this->add($element);
        
    }
    
    public function addSalutationElement($name= 'salutation')
    {
        $element = new Text($name);
        $element->setLabel('Aanhef');
        $this->add($element);
        
    }
    public function addBirthDateElement($name = 'birthdate')
    {
        $element = new Date($name);
        $element->setLabel('Geboortedatum');
        $this->add($element);
    }
    
    
    public function addBsnElement($name = 'bsn')
    {
        $element = new Text($name);
        $element->setLabel('BSN');
        $this->add($element);
    }
    
    public function addCreated_byElement($name='Created_by') {
        $element = new Text($name);
        $element->setLabel('Created_by');
        $this->add($element);
        
    }
    
    public function addCreated_tsElement($name='Created_ts') {
       $element = new DateTime($name);
        $element->setLabel('Created_ts');
        $this->add($element);
     }
    /**
     * Add submit element
     */
    public function addSubmitElement($name = 'save', $label = 'Opslaan')
    {
        $element = new Submit($name);
        $element->setValue($label);
        $element->setAttribute('class', 'btn');
        $this->add($element);
    }
}
