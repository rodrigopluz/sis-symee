<?php

// namespace Entity;
// use Doctrine\ORM\Mapping\Entity;

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * ChatMessage Model
 *
 * @package  CodeIgniter
 * @category Model
 * 
 * @Entity
 * @Table(name="chat_message")
 */
class ChatMessage extends CI_Model
{
    /**
     * @Id @GeneratedValue
     * @Column(name="id", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id;

    /**
     * 
     * @ManyToOne(targetEntity="Chat", cascade={"persist"})
     * @JoinColumn(name="id_chat", referencedColumnName="id", nullable=FALSE, unique=FALSE, onDelete="cascade")
     */
    private $_id_chat;

    /**
     * 
     * @Column(name="id_sender", type="integer", length=11, nullable=FALSE, unique=FALSE)
     */
    private $_id_sender;

    /**
     * 
     * @Column(name="message", type="string", nullable=TRUE, unique=FALSE)
     */
    private $_message;

    /**
     * 
     * @Column(name="date_time_send", type="datetime", nullable=TRUE, unique=FALSE)
     */
    private $_date_time_send;

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
     * @return Chatmessage
     */
    public function set_id($id)
    {
        $this->_id = $id;
        return $this;
    }
    /**
     * Gets id chat
     *
     * @return integer
     */
    public function get_id_chat()
    {
        return $this->_id_chat;
    }

    /**
     * Sets id chat
     *
     * @param  integer
     * @return Chatmessage
     */
    public function set_id_chat(\Chat $id_chat)
    {
        $this->_id_chat = $id_chat;
        return $this;
    }
    /**
     * Gets id sender
     *
     * @return integer
     */
    public function get_id_sender()
    {
        return $this->_id_sender;
    }

    /**
     * Sets id sender
     *
     * @param  integer
     * @return Chatmessage
     */
    public function set_id_sender($id_sender)
    {
        $this->_id_sender = $id_sender;
        return $this;
    }
    /**
     * Gets message
     *
     * @return string
     */
    public function get_message()
    {
        return $this->_message;
    }

    /**
     * Sets message
     *
     * @param  string
     * @return Chatmessage
     */
    public function set_message($message)
    {
        $this->_message = $message;
        return $this;
    }
    /**
     * Gets date time send
     *
     * @return datetime
     */
    public function get_date_time_send()
    {
        return $this->_date_time_send;
    }

    /**
     * Sets date time send
     *
     * @param  datetime
     * @return Chatmessage
     */
    public function set_date_time_send($date_time_send)
    {
        $this->_date_time_send = new \DateTime($date_time_send);
        return $this;
    }

}