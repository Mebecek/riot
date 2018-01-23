<?php

namespace FindSummonerBundle\Model\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping;
use Doctrine\ORM\Query\ResultSetMappingBuilder;
use FindSummonerBundle\Model\Entity\Mastery;

class MasteryRepository extends EntityRepository
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function getEM()
    {
        return $this->_em;
    }

    public function getRepository()
    {
        return $this->_em->getRepository(Mastery::class);
    }

    public function getMasteryByFilters($region, $points, $champion)
    {
        $query = $this->entityManager
            ->createQuery('
            SELECT p FROM FindSummonerBundle:Mastery p 
            INNER JOIN p.player ct
            WHERE p.player = ct.id AND p.championId = :champion AND p.championPoints >= :points'
            )
            ->setParameter('champion', $champion)
            ->setParameter('points', $points);

        /*
        $query = $this->entityManager->createQuery(
            'SELECT p FROM FindSummonerBundle:Mastery p WHERE p.championId = :champion AND p.championPoints >= :points'
        );
        $query->setParameters(array(
            'champion' => $champion,
            'points' => $points
        ));
        */
        return $query->getResult();
    }
}