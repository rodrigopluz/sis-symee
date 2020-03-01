<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Person Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="person")
 */
class Person extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Address", cascade={"persist"})
     * @JoinColumn(name="id_address", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_address;

    /**
     * 
     * @Column(name="name", type="string", length=145, nullable=TRUE, unique=FALSE)
     */
    private $_name;

    /**
     * 
     * @Column(name="email", type="string", length=100, nullable=TRUE, unique=FALSE)
     */
    private $_email;

    /**
     * 
     * @Column(name="status", type="tinyint", length=1, nullable=TRUE, unique=TRUE)
     */
    private $_status;

    /**
     * 
     * @Column(name="nationality", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_nationality;

    /**
     * 
     * @Column(name="token", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_token;

    /**
     * 
     * @Column(name="data_nasc", type="date", nullable=TRUE, unique=FALSE)
     */
    private $_data_nasc;

    /**
     * 
     * @Column(name="sexo", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_sexo;

    /**
     * 
     * @Column(name="phone", type="string", length=45, nullable=TRUE, unique=FALSE)
     */
    private $_phone;

    /**
     * 
     * @Column(name="type", type="char", length=1, nullable=TRUE, unique=FALSE)
     */
    private $_type;

    /**
     * 
     * @Column(name="cpf_cnpj", type="string", length=14, nullable=TRUE, unique=FALSE)
     */
    private $_cpf_cnpj;

    /**
     * 
     * @Column(name="avatar", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_avatar;

    /**
     * Gets id
     *
     * @return integer
     */
    public function get_id()
    {
        return $this->_id;
    }

    /**
     * Sets id
     *
     * @param  integer
     * @return Person
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id adress
     *
     * @return integer
     */
    public function get_id_adress()
    {
        return $this->_id_adress;
    }

    /**
     * Sets id adress
     *
     * @param  integer
     * @return Person
     */
    public function set_id_adress(\Address $id_adress)
    {
        $this->_id_adress = $id_adress;
        return $this;
    }
    /**
     * Gets name
     *
     * @return string
     */
    public function get_name()
    {
        return $this->_name;
    }

    /**
     * Sets name
     *
     * @param  string
     * @return Person
     */
    public function set_name($name)
    {
        $this->_name = $name;
        return $this;
    }
    /**
     * Gets email
     *
     * @return string
     */
    public function get_email()
    {
        return $this->_email;
    }

    /**
     * Sets email
     *
     * @param  string
     * @return Person
     */
    public function set_email($email)
    {
        $this->_email = $email;
        return $this;
    }
    /**
     * Gets status
     *
     * @return tinyint
     */
    public function get_status()
    {
        return $this->_status;
    }

    /**
     * Sets status
     *
     * @param  tinyint
     * @return Person
     */
    public function set_status($status)
    {
        $this->_status = $status;
        return $this;
    }
    /**
     * Gets nationality
     *
     * @return string
     */
    public function get_nationality()
    {
        return $this->_nationality;
    }

    /**
     * Sets nationality
     *
     * @param  string
     * @return Person
     */
    public function set_nationality($nationality)
    {
        $this->_nationality = $nationality;
        return $this;
    }
    /**
     * Gets token
     *
     * @return string
     */
    public function get_token()
    {
        return $this->_token;
    }

    /**
     * Sets token
     *
     * @param  string
     * @return Person
     */
    public function set_token($token)
    {
        $this->_token = $token;
        return $this;
    }
    /**
     * Gets data nasc
     *
     * @return date
     */
    public function get_data_nasc()
    {
        return $this->_data_nasc;
    }

    /**
     * Sets data nasc
     *
     * @param  date
     * @return Person
     */
    public function set_data_nasc($data_nasc)
    {
        $this->_data_nasc = $data_nasc;
        return $this;
    }
    /**
     * Gets sexo
     *
     * @return char
     */
    public function get_sexo()
    {
        return $this->_sexo;
    }

    /**
     * Sets sexo
     *
     * @param  char
     * @return Person
     */
    public function set_sexo($sexo)
    {
        $this->_sexo = $sexo;
        return $this;
    }
    /**
     * Gets phone
     *
     * @return string
     */
    public function get_phone()
    {
        return $this->_phone;
    }

    /**
     * Sets phone
     *
     * @param  string
     * @return Person
     */
    public function set_phone($phone)
    {
        $this->_phone = $phone;
        return $this;
    }
    /**
     * Gets type
     *
     * @return char
     */
    public function get_type()
    {
        return $this->_type;
    }

    /**
     * Sets type
     *
     * @param  char
     * @return Person
     */
    public function set_type($type)
    {
        $this->_type = $type;
        return $this;
    }
    /**
     * Gets cpf cnpj
     *
     * @return string
     */
    public function get_cpf_cnpj()
    {
        return $this->_cpf_cnpj;
    }

    /**
     * Sets cpf cnpj
     *
     * @param  string
     * @return Person
     */
    public function set_cpf_cnpj($cpf_cnpj)
    {
        $this->_cpf_cnpj = $cpf_cnpj;
        return $this;
    }
    /**
     * Gets avatar
     *
     * @return string
     */
    public function get_avatar()
    {
        return $this->_avatar;
    }

    /**
     * Sets avatar
     *
     * @param  string
     * @return Person
     */
    public function set_avatar($avatar)
    {
        $this->_avatar = $avatar;
        return $this;
    }

}