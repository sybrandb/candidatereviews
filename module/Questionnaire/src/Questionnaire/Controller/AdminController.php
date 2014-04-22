<?php
/**
 * ZF2 Buch Kapitel 18
 * 
 * Das Buch "Zend Framework 2 - Das Praxisbuch"
 * von Ralf Eggert ist im Galileo-Computing Verlag erschienen. 
 * ISBN 978-3-8362-2610-3
 * 
 * @package    Questionnaire
 * @author     Ralf Eggert <r.eggert@travello.de>
 * @copyright  Alle Listings sind urheberrechtlich geschützt!
 * @link       http://www.zendframeworkbuch.de/ und http://www.galileocomputing.de/3460
 */

/**
 * namespace definition and usage
 */
namespace Questionnaire\Controller;

use Zend\Http\PhpEnvironment\Response;
use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Questionnaire\Service\QuestionnaireServiceInterface;

/**
 * Admin controller
 * 
 * Handles the admin pages
 * 
 * @package    Questionnaire
 */
class AdminController extends AbstractActionController
{
    /**
     * @var QuestionnaireServiceInterface
     */
    protected $QuestionnaireService;
    
    /**
     * set the questionnaire service
     * 
     * @param QuestionnaireServiceInterface
     */
    public function setQuestionnaireService(QuestionnaireServiceInterface $questionnaireService)
    {
        $this->questionnaireService = $questionnaireService;

        return $this;
    }
    
    /**
     * Get the questionnaire service
     * 
     * @return QuestionnaireServiceInterface
     */
    public function getQuestionnaireService()
    {
        return $this->questionnaireService;
    }
    
    /**
     * Handle admin page
     */
    public function indexAction()
    {
        // read page from route
        $page = (int) $this->params()->fromRoute('page');
        
        // set max questionnaire per page
        $maxPage = 10;
        
        // read data and pass to view
        return new ViewModel(array(
            'questionnaireList' => $this->getQuestionnaireService()->fetchList($page, $maxPage),
        ));
    }
    
    /**
     * Handle create page
     */
    public function createAction()
    {
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute(
                'questionnaire-admin/action', array('action' => 'create')
            ), 
            true
        );

        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;
            
        // check PRG for redirect to process
        } elseif ($prg !== false) {
            // check for cancel
            if (isset($prg['cancel'])) {
                // Redirect to list of questionnaires
                return $this->redirect()->toRoute('questionnaire-admin');
            }
            
            // create with redirected data
            $questionnaire = $this->getQuestionnaireService()->save($prg);
            
            // check questionnaire
            if ($questionnaire) {
                // add messages to flash messenger
                $this->flashMessenger()->addMessage(
                    $this->getQuestionnaireService()->getMessage()
                );
                
                // Redirect to home page
                return $this->redirect()->toRoute(
                    'questionnaire-admin/action', 
                    array('action' => 'update', 'id' => $questionnaire->getId())
                );
            }
        }
        
        // get form
        $form = $this->getQuestionnaireService()->getForm('create');
        
        // add messages to flash messenger
        if ($this->getQuestionnaireService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getQuestionnaireService()->getMessage()
            );
        }
        
        // no post or registration unsuccesful
        return new ViewModel(array(
            'form' => $form,
        ));
    }
    
    /**
     * Handle update page
     */
    public function updateAction()
    {
        // read id from route and check
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('questionnaire-admin');
        }
        
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute('questionnaire-admin/action', array(), array(), true), 
            true
        );
        
        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;
            
        // check PRG for redirect to process
        } elseif ($prg !== false) {
            // check for cancel
            if (isset($prg['cancel'])) {
                // Redirect to list of questionnaires
                return $this->redirect()->toRoute('questionnaire-admin');
            }
            
            // update with redirected data
            $questionnaire = $this->getQuestionnaireService()->save($prg, $id);
            
            // check questionnaire
            if ($questionnaire) {
                // add messages to flash messenger
                $this->flashMessenger()->addMessage(
                    $this->getQuestionnaireService()->getMessage()
                );
                
                // Redirect to update questionnaire
                return $this->redirect()->toRoute(
                    'questionnaire-admin/action', array(), array(), true
                );
            }
        }
        
        // get questionnaire
        $questionnaire = $this->getQuestionnaireService()->fetchSingleById($id);
        
        // check questionnaire
        if ($questionnaire === false) {
            return $this->redirect()->toRoute('questionnaire-admin');
        }
        
        // get form and bind object
        $form = $this->getQuestionnaireService()->getForm('update');
        
        //check prg
        if ($prg === false) {
            $form->bind($questionnaire);
        }
        
        // add messages to flash messenger
        if ($this->getQuestionnaireService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getQuestionnaireService()->getMessage()
            );
        }
        
        // no post or update unsuccesful
        return new ViewModel(array(
            'form' => $form,
            'questionnaire' => $questionnaire,
        ));
    }
    
    /**
     * Handle delete page
     */
    public function deleteAction()
    {
        // read id from route and check
        $id = (int) $this->params()->fromRoute('id', 0);
        if (!$id) {
            return $this->redirect()->toRoute('questionnaire-admin');
        }
        
        // prepare Post/Redirect/Get Plugin
        $prg = $this->prg(
            $this->url()->fromRoute('questionnaire-admin/action', array(), array(), true), 
            true
        );
        
        // check PRG plugin for redirect to send
        if ($prg instanceof Response) {
            return $prg;
            
        // check PRG for redirect to process
        } elseif ($prg !== false) {
            // check for cancel
            if (isset($prg['cancel'])) {
                // Redirect to list of questionnaires
                return $this->redirect()->toRoute('questionnaire-admin');
            }
            
            // delete with redirected data
            $questionnaire = $this->getQuestionnaireService()->delete($id);
            
            // check questionnaire
            if ($questionnaire) {
                // add messages to flash messenger
                $this->flashMessenger()->addMessage(
                    $this->getQuestionnaireService()->getMessage()
                );
                
                // Redirect to list of questionnaire
                return $this->redirect()->toRoute('questionnaire-admin');
            }
        }
        
        // get questionnaire
        $questionnaire = $this->getQuestionnaireService()->fetchSingleById($id);
        
        // check questionnaire
        if ($questionnaire === false) {
            return $this->redirect()->toRoute('questionnaire-admin');
        }
        
        // get form and bind object
        $form = $this->getQuestionnaireService()->getForm('delete');
        
        //check prg
        if ($prg === false) {
            $form->bind($questionnaire);
        }
        
        // add messages to flash messenger
        if ($this->getQuestionnaireService()->getMessage()) {
            $this->flashMessenger()->addMessage(
                $this->getQuestionnaireService()->getMessage()
            );
        }
        
        // no post or update unsuccesful
        return new ViewModel(array(
            'form' => $form,
            'questionnaire' => $questionnaire,
        ));
    }
}
