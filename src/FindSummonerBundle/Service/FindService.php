<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace FindSummonerBundle\Service;

use Doctrine\ORM\EntityManagerInterface;
use FindSummonerBundle\Model\Repository\MasteryRepository;

class FindService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var MasteryRepository
     */
    private $masteryRepository;

    /**
     * Constructor
     * @param EntityManagerInterface $entityManager
     * @param MasteryRepository $masteryRepository
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        MasteryRepository $masteryRepository
    ) {
        $this->entityManager = $entityManager;
        $this->masteryRepository = $masteryRepository;
    }

    public function findSummonersByFilter($region, $points, $champions)
    {
        $return = [];
        foreach ($champions as $champion)
        {
            if ($champion != null)
            {
                $return[] = $this->masteryRepository->getMasteryByFilters($region, $points, $champion);
            }
        }
        return $return;
    }
}