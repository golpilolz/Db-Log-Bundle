<?php

namespace Golpilolz\DbLogBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * DbLog
 *
 * @ORM\Table(name="db_log")
 * @ORM\Entity(repositoryClass="Golpilolz\DbLogBundle\Repository\DbLogRepository")
 */
class DbLog
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity="Golpilolz\DbLogBundle\Entity\DbLogType")
     * @ORM\JoinColumn(nullable=false)
     */
    private $dbLogType;
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="datetimetz")
     */
    private $date;

    /**
     * @var string
     *
     * @ORM\Column(name="user", type="string", length=255)
     */
    private $user;

    /**
     * @var string
     *
     * @ORM\Column(name="message", type="text")
     */
    private $message;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getDbLogType()
    {
        return $this->dbLogType;
    }

    /**
     * @param mixed $dbLogType
     * @return DbLog
     */
    public function setDbLogType($dbLogType)
    {
        $this->dbLogType = $dbLogType;
        return $this;
    }

    /**
     * Set date
     *
     * @param \DateTime $date
     *
     * @return DbLog
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date
     *
     * @return \DateTime
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * Set user
     *
     * @param string $user
     *
     * @return DbLog
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set message
     *
     * @param string $message
     *
     * @return DbLog
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string
     */
    public function getMessage()
    {
        return $this->message;
    }
}

