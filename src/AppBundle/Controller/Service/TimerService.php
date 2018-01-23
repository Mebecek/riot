<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 20. 9. 2017
 * Time: 11:08
 */

namespace AppBundle\Controller\Service;

use AppBundle\Entity\Timer;
use ChampionBundle\Model\Repository\ChampionRepository;
use ChampionBundle\Service\ChampionService;
use Doctrine\ORM\EntityManagerInterface;

class TimerService
{
    /**
     * @var ChampionService
     */
    private $championService;

    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var ChampionRepository
     */
    private $championRepository;

    /**
     * Constructor
     * @param ChampionService $championService
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        ChampionService $championService,
        EntityManagerInterface $entityManager,
        ChampionRepository $championRepository
    ) {
        $this->championService = $championService;
        $this->entityManager = $entityManager;
        $this->championRepository = $championRepository;
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
        $championRepository = $this->championRepository->getRepository()->findAll();

        if ($championRepository == null)
        {
            if ($repository == null)
            {
                $this->saveTimer($this->createTimer($region, time()));
                return true;
            } else {
                foreach ($repository as $rep)
                {
                    $this->updateTimer($region, $rep);
                    $this->championService->getChampions($region);
                    return true;
                }
            }
        }

        if ($repository == null)
        {
            $this->saveTimer($this->createTimer($region, time()));
            $this->championService->deleteChampions();
            $this->championService->getChampions($region);
            return true;
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