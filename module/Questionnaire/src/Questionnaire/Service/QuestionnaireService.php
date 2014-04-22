<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Questionnaire\Service;

/**
 * Description of QuestionnaireService
 *
 * @author sybrandb
 */
use Zend\Db\Adapter\Exception\InvalidQueryException;
use Zend\EventManager\EventManagerInterface;
use Zend\EventManager\EventManagerAwareInterface;
use Zend\Filter\StaticFilter;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\DbSelect;
use Questionnaire\Entity\QuestionnaireEntity;
use Questionnaire\Entity\QuestionnaireEntityInterface;
use Questionnaire\Form\QuestionnaireFormInterface;
use Questionnaire\Table\QuestionnaireTableInterface;

class QuestionnaireService implements QuestionnaireServiceInterface , EventManagerAwareInterface {
    //put your code here
        /**
         * 
         * 
         */
    
         protected $eventManager = null;
    
    /**
     * @var BlogTableInterface
     */
    protected $table = null;
    
    /**
     * @var BlogFormInterface[]
     */
    protected $forms = array();

    /**
     * @var string
     */
    protected $message = null;
    
    /**
     * Constructor
     * 
     * @param BlogTableInterface $table
     * @param AuthenticationService $authentication
     */
    public function __construct(QuestionnaireTableInterface $table)
    {
        $this->setTable($table);
    }

     /* Inject an EventManager instance
     *
     * @param  EventManagerInterface $eventManager
     * @return void
     */
    public function setEventManager(EventManagerInterface $eventManager)
    {
        $eventManager->setIdentifiers(array(__CLASS__));
        $this->eventManager = $eventManager;
    }
    
    /**
     * Retrieve the event manager
     *
     * Lazy-loads an EventManager instance if none registered.
     *
     * @return EventManagerInterface
     */
    public function getEventManager()
    {
        return $this->eventManager;
    }
    
    /**
     * Get blog table
     * 
     * @return BlogTableInterface
     */
    public function getTable()
    {
        return $this->table;
    }

    public function setTable(QuestionnaireTableInterface $table) {
        $this->table = $table;
    }
   public function getMessage()
    {
        return $this->message;
    }
    
    /**
     * Clear service message
     */
    public function clearMessage()
    {
        $this->message = null;
    }
    
    /**
     * Add service message
     * 
     * @param string new message
     */
    public function setMessage($message)
    {
        $this->message = $message;
    }
    
    
    public function getForm($type = 'create')
    {
        if (!isset($this->forms[$type])) {
            $this->getEventManager()->trigger(
                'set-questionnaire-form', __CLASS__, array('type' => $type)
            );
        }
        
        return $this->forms[$type];
    }

    /**
     * Set form
     * 
     * @param BlogFormInterface $form
     * @param string $type form type
     */
    public function setForm(BlogFormInterface $form, $type = 'create')
    {
        $this->forms[$type] = $form;
    }
    public function fetchSingleById($id)
    {
        return $this->getTable()->fetchSingleById($id);
    }
    
    public function fetchSingleByName($name) {
        return $this->getTable()->fetchSingleByname($name);
    }
    
    public function fetchList($page = 1, $perPage = 15)
    {
        // Initialize select
        $select = $this->getTable()->getSql()->select();
        $select->order('name');
        
        // Initialize paginator
        $adapter = new DbSelect(
            $select, 
            $this->getTable()->getAdapter(), 
            $this->getTable()->getResultSetPrototype()
        );
        $paginator = new Paginator($adapter);
        $paginator->setCurrentPageNumber($page);
        $paginator->setItemCountPerPage($perPage);
        $paginator->setPageRange(9);
        
        // return paginator
        return $paginator;
    }
    
     public function save(array $data, $id = null)
    {
        // check mode
        $mode = is_null($id) ? 'create' : 'update';
        
        // get blog entity
        if ($mode == 'create') {
            $questionnaire = new QuestionnaireEntity();
        } else {
            $questionnaire = $this->fetchSingleById($id);
        }
        
        // get form and set data
        $form = $this->getForm($mode);
        $form->setData($data);
        
        // check for invalid data
        if (!$form->isValid()) {
            $this->setMessage('Bitte Eingaben überprüfen!');
            return false;
        }
        
        // get valid blog entity object
        $questionnaire->exchangeArray($form->getData());
        
        // set values
        if ($mode == 'create') {
            $questionnaire->setCreated_ts(date('Y-m-d H:i:s'));
        }
      //  $questionnaire->setUrl(StaticFilter::execute($blog->getTitle(), 'StringToUrl'));
        
        // get insert data
        $saveData = $questionnaire->getArrayCopy();
        
        // save blog
        try {
            if ($mode == 'create') {
                $this->getTable()->insert($saveData);
                
                // get last insert value
                $id = $this->getTable()->getLastInsertValue();
            } else {
                $this->getTable()->update($saveData, array('id' => $id));
            }
        } catch (InvalidQueryException $e) {
            $this->setMessage('Blogbeitrag wurde nicht gespeichert!');
            return false;
        }

        // reload blog
        $questionnaire = $this->fetchSingleById($id);
        
        // set success message
        $this->setMessage('Blogbeitrag wurde gespeichert!');
        
        // return blog
        return $questionnaire;
    }
    
     public function delete($id)
    {
        // fetch blog entity
        $questionnaire = $this->fetchSingleById($id);
        
        // delete existing blog
        try {
            $result = $this->getTable()->delete(array('id' => $id));
        } catch (InvalidQueryException $e) {
            return false;
        }

        // set success message
        $this->setMessage('Het questionnaire werd verwijderd!!');
        
        // return result
        return true;
    }
}
