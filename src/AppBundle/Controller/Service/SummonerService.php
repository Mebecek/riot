<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace AppBundle\Controller\Service;
use AppBundle\Controller\Classes\GuzzleHttpClient;
use AppBundle\Controller\Constant\Region;
use AppBundle\Entity\Summoner;
use AppBundle\Repository\SummonerRepository;
use Symfony\Component\DependencyInjection\ContainerInterface;

class SummonerService
{
    /**
     * @var \AppBundle\Controller\Classes\GuzzleHttpClient
     */
    private $guzzle;

    /**
     * @var ContainerInterface
     */
    private $serviceContainer;

    /**
     * @var SummonerRepository
     */
    private $repository;

    /**
     * Constructor
     * @param GuzzleHttpClient $guzzle
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(GuzzleHttpClient $guzzle, ContainerInterface $serviceContainer) {
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
    }

    /**
     * Get summoner by name
     *
     * @param $name string
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return Summoner
     */
    public function getSummonerByName($name, $region)
    {
        $request = $this->serviceContainer->getParameter('SummonerByName');
        $request = str_replace('{name}', $name, $request);
        $summoner = $this->guzzle->send($request, $region);
        return $this->createSummoner($summoner);
    }

    /**
     * Get summoner by id
     *
     * @param $name string
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return Summoner
     */
    public function getSummonerById($name, $region)
    {
        $request = $this->serviceContainer->getParameter('SummonerById');
        $request = str_replace('{id}', $name, $request);
        $summoner = $this->guzzle->send($request, $region);
        return $this->createSummoner($summoner, $region);
    }

    /**
     * Create a Summoner entity
     *
     * @param array
     * @return Summoner
     */
    private function createSummoner($object, $region)
    {
        $summoner = new Summoner();
        $summoner->setSummonerId($object->id);
        $summoner->setAccountId($object->accountId);
        $summoner->setRegion($region);
        $summoner->setName($object->name);
        $summoner->setProfileIconId($object->profileIconId);
        $summoner->setRevisionDate($object->revisionDate);
        $summoner->setSummonerLevel($object->summonerLevel);
        return $summoner;
    }
}