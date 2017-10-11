<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 28. 9. 2017
 * Time: 11:10
 */

namespace AppBundle\Repository;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;

abstract class BaseRepository extends EntityRepository
{
    public function __construct(EntityManager $em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}