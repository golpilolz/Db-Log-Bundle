<?php

namespace Golpilolz\DbLogBundle\Service;

use Doctrine\ORM\EntityManager;
use Golpilolz\DbLogBundle\Entity\DbLog;
use Golpilolz\DbLogBundle\Entity\DbLogType;

class DbLogger
{
    private $em;

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
    }

    private function addLog(DbLogType $dbLogType, $user, $message)
    {
        $date = new \DateTime();

        $dbLog = new DbLog();
        $dbLog->setDbLogType($dbLogType);
        $dbLog->setDate($date);
        $dbLog->setUser($user);
        $dbLog->setMessage($message);
    }

    public function addInfo($user, $message)
    {
        $dbLogType = $this->em->getRepository('GolpilolzDbLogBundle:DbLogType')->findOneById(3);
        $this->addLog($dbLogType, $user, $message);
    }
}