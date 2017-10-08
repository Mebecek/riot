<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20. 9. 2017
 * Time: 11:08
 */

namespace AppBundle\Controller\Service;


use AppBundle\Controller\Constant\Region;
use AppBundle\Entity\Timer;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;

class TimerService
{
    /**
     * @var ChampionService
     */
    private $championService;

    /**
     * @var EntityManager
     */
    private $entityManager;

    /**
     * Constructor
     * @param ChampionService $championService
     * @param EntityManager $entityManager
     */
    public function __construct(ChampionService $championService, EntityManager $entityManager) {
        $this->championService = $championService;
        $this->entityManager = $entityManager;
    }

    private function createTimer($region, $timestamp)
    {
        $timer = new Timer();
        $timer->setTimestamp($timestamp);
        $timer->setVersion($this->championService->getChampionsVersion($region));
        return $timer;
    }

    private function saveTimer($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    private function updateTimer($region, $object)
    {
        $timer = $this->getRepository()->find($object);
        $timer->setTimestamp(time());
        $timer->setVersion($this->championService->getChampionsVersion($region));
        $this->entityManager->flush();
    }

    private function getRepository()
    {
        return $this->entityManager->getRepository(Timer::class);
    }

    public function checkTimer($region)
    {
        $repository = $this->getRepository()->findAll();

        if ($repository == null)
        {
            $this->saveTimer($this->createTimer($region, time()));
        } else {
            foreach ($repository as $rep)
            {
                if (time() >= ($rep->getTimestamp() + 3600))
                {
                    $this->updateTimer($region, $rep);

                    if ($this->championService->getChampionsVersion($region) != $rep->getVersion())
                    {
                        $this->championService->deleteChampions();
                        $this->championService->getChampions($region);
                        return true;
                    }
                }
            }
        }
        return false;
    }
}