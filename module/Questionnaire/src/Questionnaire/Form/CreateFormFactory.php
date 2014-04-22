<?php
/**
 * ZF2 Buch Kapitel 18
 * 
 * Das Buch "Zend Framework 2 - Das Praxisbuch"
 * von Ralf Eggert ist im Galileo-Computing Verlag erschienen. 
 * ISBN 978-3-8362-2610-3
 * 
 * @package    Blog
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Alle Listings sind urheberrechtlich geschützt!
 * @link       http://www.zendframeworkbuch.de/ und http://www.galileocomputing.de/3460
 */

/**
 * namespace definition and usage
 */
namespace Questionnaire\Form;

use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 * Create form factory
 * 
 * @package    Blog
 */
class CreateFormFactory implements FactoryInterface
{
    /**
     * Create Service Factory
     * 
     * @param ServiceLocatorInterface $serviceLocator
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $inputFilterManager = $serviceLocator->get('InputFilterManager');
        
        $form = new QuestionnaireForm('create');
        $form->addCsrfElement();
        $form->addNameElement();
        $form->addDescriptionElement();
        $form->addMaxtimeElement();
        $form->addScoreElement();
        $form->addPassing_scoreElement();
        $form->addSubmitElement('save', 'Opslaan');
        $form->addSubmitElement('cancel', 'Afbreken');
        $form->setInputFilter($inputFilterManager->get('Questionnaire\Filter\Questionnaire'));
        $form->setValidationGroup(
            array('name', 'description', 'maxtime', 'score','passing_score', 'save', 'cancel')
        );
        return $form;
    }
}
