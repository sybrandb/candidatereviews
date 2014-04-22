<?php
/**
 * ZF2 Buch Kapitel 17
 * 
 * Das Buch "Zend Framework 2 - Das Praxisbuch"
 * von Ralf Eggert ist im Galileo-Computing Verlag erschienen. 
 * ISBN 978-3-8362-2610-3
 * 
 * @package    User
 * @author     Sybrand Bakker <sybrandb@hccnet.nl>
 * @copyright  Alle Listings sind urheberrechtlich geschützt!
 * @link       http://www.zendframeworkbuch.de/ und http://www.galileocomputing.de/3460
 */

/**
 * namespace definition and usage
 */
namespace User\Entity;

use Zend\Stdlib\ArraySerializableInterface;

/**
 * User entity interface
 * 
 * @package    User
 */
interface UserEntityInterface extends ArraySerializableInterface
{
    /**
     * Set id
     * 
     * @param integer $id
     */
    public function setId($id);
    
    /**
     * Get id
     * 
     * @return integer $id
     */
    public function getId();
    
    /**
     * Set role
     * 
     * @param string $role
     */
    public function setRole($role);
    
    /**
     * Get role
     * 
     * @return string $role
     */
    public function getRole();
    
    /**
     * Get role name
     * 
     * @return string $role
     */
    public function getRoleName();
    
    /**
     * Get role names
     * 
     * @return array list of roles
     */
    public function getRoleNames();
    
    /**
     * Set email
     * 
     * @param string $email
     */
    public function setEmail($email);
    
    /**
     * Get email
     * 
     * @return string $email
     */
    public function getEmail();
    
    /**
     * Set pass
     * 
     * @param string $pass
     */
    public function setPass($pass);
    
    /**
     * Get pass
     * 
     * @return string $pass
     */
    public function getPass();
    
    /**
     * Set firstname
     * 
     * @param string $firstname
     */
    public function setFirstname($firstname);
    
    /**
     * Get firstname
     * 
     * @return string $firstname
     */
    public function getFirstname();
    
    /**
     * Set lastname
     * 
     * @param string $lastname
     */
    public function setLastname($lastname);
    
    /**
     * Get lastname
     * 
     * @return string $lastname
     */
    public function getLastname();
    
    public function setGender($gender);
    
    public function getGender();
    
    public function setSalutation($salutation);
    
    public function getSalutation();
    
    public function getBirthdate();
    
    public function setBirthdate($birthdate);
    
    public function getBsn();
    
    public function setBsn($bsn);
    
    public function getCreated_ts();
    
    public function setCreated_ts($created_ts);
    
    public function getCreated_by();
    
    public function setCreated_by($created_by);

    
    public function getUpdated_ts();
    
    public function setUpdated_ts($updated_ts);
    
    public function getUpdated_by();
    
    public function setUpdated_by($updated_by);

}
