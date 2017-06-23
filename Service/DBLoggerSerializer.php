<?php

namespace Golpilolz\DbLogBundle\Service;

use Doctrine\ORM\EntityManager;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class DBLoggerSerializer
{
    private $em;

    private $serializer;

    private $formats = [
        'json',
        'xml'
    ];

    public function __construct(EntityManager $entityManager)
    {
        $this->em = $entityManager;
        $encoders = array(new XmlEncoder(), new JsonEncoder());
        $normalizers = array(new ObjectNormalizer());
        $this->serializer = new Serializer($normalizers, $encoders);
    }

    private function serialize($format, $from)
    {
        if(is_null($from)){
            $logs = $this->em->getRepository('GolpilolzDbLogBundle:DbLog')->findAll();
        } else {
            $logs = [];
        }

        return $this->serializer->serialize($logs, $format);
    }

    public function toJSON($from = null)
    {
        return $this->serialize('json', $from);
    }

    public function toXML($from = null)
    {
        return $this->serialize('xml', $from);
    }
}