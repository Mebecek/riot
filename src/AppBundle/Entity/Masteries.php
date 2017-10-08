<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22. 9. 2017
 * Time: 12:39
 */

namespace AppBundle\Entity;


class Masteries
{
    /**
     * @var string
     */
    private $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }
}