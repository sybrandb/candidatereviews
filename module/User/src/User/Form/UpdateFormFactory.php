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

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Update form factory
 * 
 * @package    User
 */
class UpdateFormFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $inputFilterManager = $serviceLocator->get('InputFilterManager');
        
        $userEntity  = $serviceLocator->get('User\Entity\User');
        $roleOptions = $userEntity->getRoleNames(); // feitelijk hardcoced List of Values
        
        $form = new UserForm('update');
        $form->addIdElement();
        $form->addCsrfElement();
        $form->addRoleElement($roleOptions);
        $form->addEmailElement();
        $form->addPassElement();
        $form->addFirstnameElement();
        $form->addLastnameElement();
        $form->addGenderElement();
        $form->addSalutationElement();
        $form->addBirthDateElement();
        $form->addBsnElement();
        $form->addCreated_byElement();
        $form->addCreated_tsElement();
        $form->addSubmitElement('save', 'Opslaan');
        $form->addSubmitElement('cancel', 'Afbreken');
        $form->setInputFilter($inputFilterManager->get('User\Filter\User'));
        $form->getInputFilter()->get('pass')->setRequired(false);
        $form->setValidationGroup(array(
            'id', 'role', 'email', 'pass', 'firstname', 'lastname', 'birthdate','salutation','bsn','gender',
            'save', 'cancel'
        ));
        return $form;
    }
}
