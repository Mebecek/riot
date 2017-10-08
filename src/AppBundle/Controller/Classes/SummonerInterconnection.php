<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 25. 9. 2017
 * Time: 12:25
 */

namespace AppBundle\Controller\Classes;


use AppBundle\Controller\Service\MasteriesService;

class SummonerInterconnection
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var MasteriesService
     */
    private $masteriesService;

    /**
     * Constructor
     * @param Generator $generator
     * @param MasteriesService $masteriesService
     */
    public function __construct(Generator $generator, MasteriesService $masteriesService) {
        $this->generator = $generator;
        $this->masteriesService = $masteriesService;
    }


}