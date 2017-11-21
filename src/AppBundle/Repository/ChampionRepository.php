<?php

namespace AppBundle\Repository;

use AppBundle\Entity\Champion;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

class ChampionRepository extends EntityRepository
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
        return $this->_em->getRepository(Champion::class);
    }
}