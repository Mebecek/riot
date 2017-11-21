<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22. 9. 2017
 * Time: 12:58
 */

namespace AppBundle\Controller\Service;

use AppBundle\Entity\Masteries;
use AppBundle\Controller\Classes\GuzzleHttpClient;
use Doctrine\ORM\EntityManager;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MasteriesService
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
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Constructor
     * @param GuzzleHttpClient $guzzle
     * @param ContainerInterface $serviceContainer
     * @param EntityManager $entityManager
     */
    public function __construct(GuzzleHttpClient $guzzle, ContainerInterface $serviceContainer, EntityManager $entityManager) {
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
        $this->entityManager = $entityManager;
    }

    /**
     * Retrieves summoner's masteries
     *
     * @param integer $id the id of the champion
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return array
     */
    public function getMasteriesById($id, $region)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('The "id" must be an int');
        }
        $request = $this->serviceContainer->getParameter('masterie')['masteries'];
        $request = str_replace('{id}', $id, $request);
        $masterie = $this->guzzle->send($request, $region);
        return $this->createMasteries($masterie->pages);
    }

    private function createMasteries($masteries)
    {
        $return = array();

        foreach($masteries as $masterie)
        {
            $newMastery = $this->createMasterie($masterie);
            $return[] = $newMastery;
        }
        return $return;
    }

    private function createMasterie($masterie)
    {
        $masteries = new Masteries();
        $masteries->setName($masterie->name);
        return $masteries;
    }
}