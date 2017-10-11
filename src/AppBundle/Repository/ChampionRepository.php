<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28. 9. 2017
 * Time: 11:10
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Champion;
use Doctrine\ORM\Mapping;

class ChampionRepository extends BaseRepository
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