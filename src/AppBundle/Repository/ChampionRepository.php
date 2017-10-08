<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28. 9. 2017
 * Time: 11:10
 */

namespace AppBundle\Repository;


use AppBundle\Entity\Champion;
use Doctrine\ORM\EntityRepository;

class ChampionRepository extends EntityRepository
{
    public function getEM()
    {
        return $this->getEntityManager();
    }

    public function getRepository()
    {
        return $this->getEM()->getRepository(Champion::class);
    }
}