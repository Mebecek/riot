<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class SummonerRepository extends EntityRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }

    public function getEM()
    {
        return $this->_em;
    }

    public function getRepository()
    {
        return $this->_em->getRepository(Summoner::class);
    }
}