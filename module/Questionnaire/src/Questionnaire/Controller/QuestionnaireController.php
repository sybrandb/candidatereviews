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


use Zend\View\Model\ViewModel;
use Zend\Mvc\Controller\AbstractActionController;
use Questionnaire\Service\QuestionnaireServiceInterface;

/**
 * Questionnaire controller
 * 
 * Handles the blog pages
 * 
 * @package    Questionnaire
 */
class QuestionnaireController extends AbstractActionController
{
    /**
     * @var QuestionnaireServiceInterface
     */
    protected $questionnaireService;
    
    /**
     * set the blog service
     * 
     * @param QuestionnaireServiceInterface
     */
    public function setQuestionnaireService(QuestionnaireServiceInterface $questionnaireService)
    {
        $this->questionnaireService = $questionnaireService;

        return $this;
    }
    
    /**
     * Get the blog service
     * 
     * @return QuestionnaireServiceInterface
     */
    public function getQuestionnaireService()
    {
        return $this->questionaireService;
    }
    
    /**
     * Handle blog page
     */
    public function indexAction()
    {
        // read page from route
        $page = (int) $this->params()->fromRoute('page');
        
        // set max blog per page
        $maxPage = 10;
        
        // read data and pass to view
        return new ViewModel(array(
            'blogList' => $this->getQuestionnaireService()->fetchList($page, $maxPage),
        ));
    }
    
    /**
     * Handle show page
     */
    public function showAction()
    {
        // read url from route
        $url = $this->params()->fromRoute('url');
        
        // fetch data
        $questionnaireData = $this->getQuestionnaireService()->fetchSingleByUrl($url);
        
        // check data
        if (!$questionnaireData) {
            // Redirect to blog page
            return $this->redirect()->toRoute('questionnaire');
        }
        
        // read data and pass to view
        return new ViewModel(array(
            'questionnaireData' => $questionnaireData,
        ));
    }
    
    
}
