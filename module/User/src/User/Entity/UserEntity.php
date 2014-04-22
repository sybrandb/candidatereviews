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

/**
 * User entity
 * 
 * @package    User
 */
class UserEntity implements UserEntityInterface
{
    protected $roleNames = array(
        'candidate' => 'Kandidaat',
        'staff'     => 'Medewerker',
        'admin'     => 'Administrator'
    );
    
    protected $id;
    protected $lastname;
    protected $firstname;
    protected $gender;
    protected $salutation;
    protected $email;
    protected $birthdate;
    protected $bsn;
    protected $pass;
    protected $role;
    protected $created_ts;
    protected $created_by;
    protected $updated_ts;
    protected $updated_by;
    
    /**
     * Set id
     * 
     * @param integer $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }
    
    /**
     * Get id
     * 
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * Set role
     * 
     * @param string $role
     */
    public function setRole($role)
    {
        $this->role = $role;
    }
    
    /**
     * Get role
     * 
     * @return string $role
     */
    public function getRole()
    {
        return $this->role;
    }
    
    /**
     * Get role name
     * 
     * @return string $role
     */
    public function getRoleName()
    {
        return $this->roleNames[$this->role];
    }
    
    /**
     * Get role names
     * 
     * @return array list of roles
     */
    public function getRoleNames()
    {
        return $this->roleNames;
    }
    
    /**
     * Set email
     * 
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }
    
    /**
     * Get email
     * 
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }
    
    /**
     * Set pass
     * 
     * @param string $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }
    
    /**
     * Get pass
     * 
     * @return string $pass
     */
    public function getPass()
    {
        return $this->pass;
    }
    
    /**
     * Set firstname
     * 
     * @param string $firstname
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;
    }
    
    /**
     * Get firstname
     * 
     * @return string $firstname
     */
    public function getFirstname()
    {
        return $this->firstname;
    }
    
    /**
     * Set lastname
     * 
     * @param string $lastname
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;
    }
    
    /**
     * Get lastname
     * 
     * @return string $lastname
     */
    public function getLastname()
    {
        return $this->lastname;
    }
    
    /**
     *  Get gender
     * 
     * @return string $gender
     * 
     */
    public function getGender()
    {
        return $this->gender;
   
    }
    
    /**
     * Set gender
     * 
     * @param string $gender
     */
    
    public function setGender($gender) {
        $this->gender = $gender;
    }

    /**
     *  Get gender
     * 
     * @return string $salutation
     * 
     */
    public function getSalutation()
    {
        return $this->salutation;
   
    }
    
    /**
     * Set salutation
     * 
     * @param string $salutation
     */
    
    public function setSalutation($salutation) {
        $this->salutation = $salutation;
    }

    /**
     *  Get birthdate
     * 
     * @return string $birthdate
     * 
     */
    public function getBirthdate()
    {
        return $this->birthdate;
   
    }
    
    /**
     * Set birthdate
     * 
     * @param string $birthdate
     */
    
    
    
    public function setBirthdate($birthdate) {
        $this->birthdate = $birthdate;
    }
 
    public function getBsn()
    {
        return $this->bsn;
   
    }
    
    /**
     * Set bsn
     * 
     * @param string $bsn
     */
    
    public function setBsn($bsn) {
        $this->bsn = $bsn;
    }
    
    
      public function getCreated_ts()
    {
        return $this->created_ts;
   
    }
    
    public function setCreated_ts($created_ts) {
        $this->created_ts = $created_ts;
    }
    
    public function getCreated_by() {
        return $this->created_by;
        
    }
    
    public function setCreated_by($created_by) {
        $this->created_by = $created_by;
    }
 
         public function getUpdated_ts()
    {
        return $this->updated_ts;
   
    }
    
    public function setUpdated_ts($updated_ts) {
        $this->updated_ts = $updated_ts;
    }
    
    public function getUpdated_by() {
        return $this->updated_by;
        
    }
    
    public function setUpdated_by($updated_by) {
        $this->updated_by = $updated_by;
    }
 
    
    
    /**
     * Exchange internal values from provided array
     *
     * @param  array $array
     * @return void
     */
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
            'id'         => $this->getId(),
            'role'       => $this->getRole(),
            'email'      => $this->getEmail(),
            'pass'       => $this->getPass(),
            'firstname'  => $this->getFirstname(),
            'lastname'   => $this->getLastname(),
            'gender'     => $this->getGender(),
            'salutation' => $this->getSalutation(),
            'birthdate'  => $this->getBirthdate(),
            'bsn'        => $this->getBsn(),
            'created_by' => $this->getCreated_by(),
            'created_ts' => $this->getCreated_ts(),
            'updated_by' => $this->getUpdated_by(),
            'updated_ts' => $this->getUpdated_ts(),
        );
    }
}
