<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 27. 7. 2017
 * Time: 13:20
 */

namespace AppBundle\Repository;

use AppBundle\Entity\Champion;
use Doctrine\ORM\Mapping;

class CommentRepository extends BaseRepository
{
    public function __construct($em, Mapping\ClassMetadata $class)
    {
        parent::__construct($em, $class);
    }
}