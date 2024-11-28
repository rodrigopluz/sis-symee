<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Language Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="language")
 */
class Language extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @Column(name="phrase", type="string", length=255, nullable=FALSE, unique=FALSE)
     */
    private $_phrase;

    /**
     * 
     * @Column(name="english", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_english;

    /**
     * 
     * @Column(name="portuguese", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_portuguese;

    /**
     * 
     * @Column(name="spanish", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_spanish;

    /**
     * 
     * @Column(name="french", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_french;

    /**
     * 
     * @Column(name="german", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_german;

    /**
     * 
     * @Column(name="italian", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_italian;

    /**
     * 
     * @Column(name="bengali", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_bengali;

    /**
     * 
     * @Column(name="arabic", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_arabic;

    /**
     * 
     * @Column(name="dutch", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_dutch;

    /**
     * 
     * @Column(name="russian", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_russian;

    /**
     * 
     * @Column(name="chinese", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_chinese;

    /**
     * 
     * @Column(name="turkish", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_turkish;

    /**
     * 
     * @Column(name="hungarian", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_hungarian;

    /**
     * 
     * @Column(name="greek", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_greek;

    /**
     * 
     * @Column(name="thai", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_thai;

    /**
     * 
     * @Column(name="urdu", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_urdu;

    /**
     * 
     * @Column(name="hindi", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_hindi;

    /**
     * 
     * @Column(name="latin", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_latin;

    /**
     * 
     * @Column(name="indonesian", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_indonesian;

    /**
     * 
     * @Column(name="japanese", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_japanese;

    /**
     * 
     * @Column(name="korean", type="string", length=255, nullable=TRUE, unique=FALSE)
     */
    private $_korean;

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
     * @return Language
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets phrase
     *
     * @return string
     */
    public function get_phrase()
    {
        return $this->_phrase;
    }

    /**
     * Sets phrase
     *
     * @param  string
     * @return Language
     */
    public function set_phrase($phrase)
    {
        $this->_phrase = $phrase;
        return $this;
    }
    /**
     * Gets english
     *
     * @return string
     */
    public function get_english()
    {
        return $this->_english;
    }

    /**
     * Sets english
     *
     * @param  string
     * @return Language
     */
    public function set_english($english)
    {
        $this->_english = $english;
        return $this;
    }
    /**
     * Gets portuguese
     *
     * @return string
     */
    public function get_portuguese()
    {
        return $this->_portuguese;
    }

    /**
     * Sets portuguese
     *
     * @param  string
     * @return Language
     */
    public function set_portuguese($portuguese)
    {
        $this->_portuguese = $portuguese;
        return $this;
    }
    /**
     * Gets spanish
     *
     * @return string
     */
    public function get_spanish()
    {
        return $this->_spanish;
    }

    /**
     * Sets spanish
     *
     * @param  string
     * @return Language
     */
    public function set_spanish($spanish)
    {
        $this->_spanish = $spanish;
        return $this;
    }
    /**
     * Gets french
     *
     * @return string
     */
    public function get_french()
    {
        return $this->_french;
    }

    /**
     * Sets french
     *
     * @param  string
     * @return Language
     */
    public function set_french($french)
    {
        $this->_french = $french;
        return $this;
    }
    /**
     * Gets german
     *
     * @return string
     */
    public function get_german()
    {
        return $this->_german;
    }

    /**
     * Sets german
     *
     * @param  string
     * @return Language
     */
    public function set_german($german)
    {
        $this->_german = $german;
        return $this;
    }
    /**
     * Gets italian
     *
     * @return string
     */
    public function get_italian()
    {
        return $this->_italian;
    }

    /**
     * Sets italian
     *
     * @param  string
     * @return Language
     */
    public function set_italian($italian)
    {
        $this->_italian = $italian;
        return $this;
    }
    /**
     * Gets bengali
     *
     * @return string
     */
    public function get_bengali()
    {
        return $this->_bengali;
    }

    /**
     * Sets bengali
     *
     * @param  string
     * @return Language
     */
    public function set_bengali($bengali)
    {
        $this->_bengali = $bengali;
        return $this;
    }
    /**
     * Gets arabic
     *
     * @return string
     */
    public function get_arabic()
    {
        return $this->_arabic;
    }

    /**
     * Sets arabic
     *
     * @param  string
     * @return Language
     */
    public function set_arabic($arabic)
    {
        $this->_arabic = $arabic;
        return $this;
    }
    /**
     * Gets dutch
     *
     * @return string
     */
    public function get_dutch()
    {
        return $this->_dutch;
    }

    /**
     * Sets dutch
     *
     * @param  string
     * @return Language
     */
    public function set_dutch($dutch)
    {
        $this->_dutch = $dutch;
        return $this;
    }
    /**
     * Gets russian
     *
     * @return string
     */
    public function get_russian()
    {
        return $this->_russian;
    }

    /**
     * Sets russian
     *
     * @param  string
     * @return Language
     */
    public function set_russian($russian)
    {
        $this->_russian = $russian;
        return $this;
    }
    /**
     * Gets chinese
     *
     * @return string
     */
    public function get_chinese()
    {
        return $this->_chinese;
    }

    /**
     * Sets chinese
     *
     * @param  string
     * @return Language
     */
    public function set_chinese($chinese)
    {
        $this->_chinese = $chinese;
        return $this;
    }
    /**
     * Gets turkish
     *
     * @return string
     */
    public function get_turkish()
    {
        return $this->_turkish;
    }

    /**
     * Sets turkish
     *
     * @param  string
     * @return Language
     */
    public function set_turkish($turkish)
    {
        $this->_turkish = $turkish;
        return $this;
    }
    /**
     * Gets hungarian
     *
     * @return string
     */
    public function get_hungarian()
    {
        return $this->_hungarian;
    }

    /**
     * Sets hungarian
     *
     * @param  string
     * @return Language
     */
    public function set_hungarian($hungarian)
    {
        $this->_hungarian = $hungarian;
        return $this;
    }
    /**
     * Gets greek
     *
     * @return string
     */
    public function get_greek()
    {
        return $this->_greek;
    }

    /**
     * Sets greek
     *
     * @param  string
     * @return Language
     */
    public function set_greek($greek)
    {
        $this->_greek = $greek;
        return $this;
    }
    /**
     * Gets thai
     *
     * @return string
     */
    public function get_thai()
    {
        return $this->_thai;
    }

    /**
     * Sets thai
     *
     * @param  string
     * @return Language
     */
    public function set_thai($thai)
    {
        $this->_thai = $thai;
        return $this;
    }
    /**
     * Gets urdu
     *
     * @return string
     */
    public function get_urdu()
    {
        return $this->_urdu;
    }

    /**
     * Sets urdu
     *
     * @param  string
     * @return Language
     */
    public function set_urdu($urdu)
    {
        $this->_urdu = $urdu;
        return $this;
    }
    /**
     * Gets hindi
     *
     * @return string
     */
    public function get_hindi()
    {
        return $this->_hindi;
    }

    /**
     * Sets hindi
     *
     * @param  string
     * @return Language
     */
    public function set_hindi($hindi)
    {
        $this->_hindi = $hindi;
        return $this;
    }
    /**
     * Gets latin
     *
     * @return string
     */
    public function get_latin()
    {
        return $this->_latin;
    }

    /**
     * Sets latin
     *
     * @param  string
     * @return Language
     */
    public function set_latin($latin)
    {
        $this->_latin = $latin;
        return $this;
    }
    /**
     * Gets indonesian
     *
     * @return string
     */
    public function get_indonesian()
    {
        return $this->_indonesian;
    }

    /**
     * Sets indonesian
     *
     * @param  string
     * @return Language
     */
    public function set_indonesian($indonesian)
    {
        $this->_indonesian = $indonesian;
        return $this;
    }
    /**
     * Gets japanese
     *
     * @return string
     */
    public function get_japanese()
    {
        return $this->_japanese;
    }

    /**
     * Sets japanese
     *
     * @param  string
     * @return Language
     */
    public function set_japanese($japanese)
    {
        $this->_japanese = $japanese;
        return $this;
    }
    /**
     * Gets korean
     *
     * @return string
     */
    public function get_korean()
    {
        return $this->_korean;
    }

    /**
     * Sets korean
     *
     * @param  string
     * @return Language
     */
    public function set_korean($korean)
    {
        $this->_korean = $korean;
        return $this;
    }

}