<?php
namespace App\Classes\Entity;

class User {

    private $_id ;
    private $_email ;
    private $_password ;

    public function __construct(array $ligne)
    {
        $this->hydrate($ligne);
    }

    public function hydrate(array $ligne)
    {
        foreach($ligne as $key => $value){
            $method = 'set'.ucfirst($key);
            if (method_exists($this, $method)) {
                $this->$method($value); // on appel une methode qui est dans la variable donc on ajoute un $
            }
        }
    }
    public function __toString():string
    {
        return $this->getEmail();
    }


        /**
     * Get the value of _id 
     */ 
    public function getId()
    {
        return $this->_id;
    }

    /**
     * Set the value of _id
     *
     * @return  self
     */ 
    public function setId($_id)
    {
        $this->_id = $_id;

        return $this;
    }

    /**
     * Get the value of _email
     */ 
    public function getEmail()
    {
        return $this->_email;
    }

    /**
     * Set the value of _email
     *
     * @return  self
     */ 
    public function setEmail($_email)
    {
        $this->_email = $_email;

        return $this;
    }

    /**
     * Get the value of _password
     */ 
    public function getPassword()
    {
        return $this->_password;
    }

    /**
     * Set the value of _password
     *
     * @return  self
     */ 
    public function setPassword($_password)
    {
        $this->_password = password_hash($_password, PASSWORD_BCRYPT);

        return $this;
    }

}

?>