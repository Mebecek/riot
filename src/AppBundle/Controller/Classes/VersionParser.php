<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 23. 9. 2017
 * Time: 21:18
 */

namespace AppBundle\Controller\Classes;

use GuzzleHttp\Client;
use AppBundle\Controller\Constant\Region;
use Symfony\Component\DependencyInjection\ContainerInterface;

class VersionParser
{
    /**
     * @var GuzzleHttpClient
     */
    private $guzzle;
    /**
     * @var ContainerInterface
     */
    private $serviceContainer;

    /**
     * Constructor
     * @param ContainerInterface $serviceContainer
     * @param GuzzleHttpClient $guzzle
     */
    public function __construct(ContainerInterface $serviceContainer, GuzzleHttpClient $guzzle) {
        $this->serviceContainer = $serviceContainer;
        $this->guzzle = new Client();
    }

    public function getVersions()
    {
        $request = $this->serviceContainer->getParameter('dragonVersions');
        $response = $this->guzzle->get($request);
        return json_decode($response->getBody());
    }


    public function getLastVersion()
    {
        return $this->getVersions()[0];
    }

    public function getDragonData()
    {
        $request = $this->serviceContainer->getParameter('dragonData');

        $array = array();

        foreach($request as $data)
        {
            $array[] = str_replace('{version}', $this->getLastVersion(), $data);
        }
        return $array;
    }
}