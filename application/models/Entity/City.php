<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * City Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="city")
 */
class City extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="nome", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_nome;

    /**
     * 
     * @ManyToOne(targetEntity="States", cascade={"persist"})
     * @JoinColumn(name="sigla", referencedColumnName="sigla", nullable=TRUE, unique=FALSE, onDelete="cascade")
     */
    private $_sigla;

    /**
     * 
     * @Column(name="subst_tributaria", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_subst_tributaria;

    /**
     * 
     * @Column(name="initial", type="string", length=3, nullable=TRUE, unique=FALSE)
     */
    private $_initial;

    /**
     * 
     * @Column(name="cod_siafi", type="string", length=25, nullable=TRUE, unique=FALSE)
     */
    private $_cod_siafi;

    /**
     * 
     * @Column(name="cod_municipio_ibge", type="integer", length=11, nullable=TRUE, unique=FALSE)
     */
    private $_cod_municipio_ibge;

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
     * @return City
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets nome
     *
     * @return string
     */
    public function get_nome()
    {
        return $this->_nome;
    }

    /**
     * Sets nome
     *
     * @param  string
     * @return City
     */
    public function set_nome($nome)
    {
        $this->_nome = $nome;
        return $this;
    }
    /**
     * Gets sigla
     *
     * @return char
     */
    public function get_sigla()
    {
        return $this->_sigla;
    }

    /**
     * Sets sigla
     *
     * @param  char
     * @return City
     */
    public function set_sigla(\States $sigla)
    {
        $this->_sigla = $sigla;
        return $this;
    }
    /**
     * Gets subst tributaria
     *
     * @return integer
     */
    public function get_subst_tributaria()
    {
        return $this->_subst_tributaria;
    }

    /**
     * Sets subst tributaria
     *
     * @param  integer
     * @return City
     */
    public function set_subst_tributaria($subst_tributaria)
    {
        $this->_subst_tributaria = $subst_tributaria;
        return $this;
    }
    /**
     * Gets pais id
     *
     * @return string
     */
    public function get_initial()
    {
        return $this->_initial;
    }

    /**
     * Sets pais id
     *
     * @param  string
     * @return City
     */
    public function set_initial($initial)
    {
        $this->_initial = $initial;
        return $this;
    }
    /**
     * Gets cod siafi
     *
     * @return string
     */
    public function get_cod_siafi()
    {
        return $this->_cod_siafi;
    }

    /**
     * Sets cod siafi
     *
     * @param  string
     * @return City
     */
    public function set_cod_siafi($cod_siafi)
    {
        $this->_cod_siafi = $cod_siafi;
        return $this;
    }
    /**
     * Gets cod municipio ibge
     *
     * @return integer
     */
    public function get_cod_municipio_ibge()
    {
        return $this->_cod_municipio_ibge;
    }

    /**
     * Sets cod municipio ibge
     *
     * @param  integer
     * @return City
     */
    public function set_cod_municipio_ibge($cod_municipio_ibge)
    {
        $this->_cod_municipio_ibge = $cod_municipio_ibge;
        return $this;
    }

}