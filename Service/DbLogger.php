<?php

namespace Golpilolz\DbLogBundle\Service;

use Doctrine\ORM\EntityManager;
use Golpilolz\DbLogBundle\Entity\DbLog;
use Golpilolz\DbLogBundle\Entity\DbLogType;
use Psr\Log\InvalidArgumentException;

class DbLogger
{
    /**
     * Project default Entity manager
     *
     * @var EntityManager
     */
    private $em;

    /**
     * Detailed debug information
     */
    const DEBUG = 100;

    /**
     * Interesting events
     *
     * Examples: User logs in, SQL logs.
     */
    const INFO = 200;

    /**
     * Uncommon events
     */
    const NOTICE = 250;

    /**
     * Exceptional occurrences that are not errors
     *
     * Examples: Use of deprecated APIs, poor use of an API,
     * undesirable things that are not necessarily wrong.
     */
    const WARNING = 300;

    /**
     * Runtime errors
     */
    const ERROR = 400;

    /**
     * Critical conditions
     *
     * Example: Application component unavailable, unexpected exception.
     */
    const CRITICAL = 500;

    /**
     * Action must be taken immediately
     *
     * Example: Entire website down, database unavailable, etc.
     * This should trigger the SMS alerts and wake you up.
     */
    const ALERT = 550;

    /**
     * Urgent alert.
     */
    const EMERGENCY = 600;

    /**
     * Monolog API version
     *
     * This is only bumped when API breaks are done and should
     * follow the major version of the library
     *
     * @var int
     */
    const API = 1;

    /**
     * Logging levels from syslog protocol defined in RFC 5424
     *
     * @var array $levels Logging levels
     */
    protected static $levels = array(
        self::DEBUG => 'DEBUG',
        self::INFO => 'INFO',
        self::NOTICE => 'NOTICE',
        self::WARNING => 'WARNING',
        self::ERROR => 'ERROR',
        self::CRITICAL => 'CRITICAL',
        self::ALERT => 'ALERT',
        self::EMERGENCY => 'EMERGENCY',
    );

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    private function addLog($level, $user, $message)
    {
        $date = new \DateTime();

        static::getLevelName($level);

        $dbLog = new DbLog();
        $dbLog->setLevel($level);
        $dbLog->setDate($date);
        $dbLog->setUser($user);
        $dbLog->setMessage($message);
        $this->em->persist($dbLog);
        $this->em->flush();
    }

    public function addDebug($user, $message)
    {
        $this->addLog(static::DEBUG, $user, $message);
    }

    public function addInfo($user, $message)
    {
        $this->addLog(static::INFO, $user, $message);
    }

    /**
     * Gets the name of the logging level.
     *
     * @param  int $level
     * @return string
     */
    public static function getLevelName($level)
    {
        if (!isset(static::$levels[$level])) {
            throw new InvalidArgumentException('Level "' . $level . '" is not defined, use one of: ' . implode(', ', array_keys(static::$levels)));
        }

        return static::$levels[$level];
    }
}