<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace FindSummonerBundle\Service;

use AppBundle\Controller\Classes\GuzzleHttpClient;
use AppBundle\Controller\Service\SummonerService;
use AppBundle\Entity\Summoner;
use Doctrine\ORM\EntityManagerInterface;
use FindSummonerBundle\Model\Entity\League;
use FindSummonerBundle\Model\Entity\Mastery;
use FindSummonerBundle\Model\Entity\Player;
use ChampionBundle\Model\Repository\ChampionRepository;
use AppBundle\Repository\SummonerRepository;
use FindSummonerBundle\Model\Entity\SummonerLeague;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class LeagueService
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * @var GuzzleHttpClient
     */
    private $guzzle;

    /**
     * @var ContainerInterface
     */
    private $serviceContainer;

    /**
     * @var ChampionRepository
     */
    private $repository;

    /**
     * @var SummonerRepository
     */
    private $summonerRepository;

    /**
     * @var SummonerService
     */
    private $summonerService;

    /**
     * @var array
     */
    private $list = [
        [
            'eune', 65917314, 37178531, 35504770, 52126243, 37465735, 38239275, 19706876
        ],
        [
            'na', 91655381
        ]
    ];

    /**
     * Constructor
     * @param GuzzleHttpClient $guzzle
     */
    public function __construct(
        EntityManagerInterface $entityManager,
        GuzzleHttpClient $guzzle,
        ContainerInterface $serviceContainer,
        ChampionRepository $championRepository,
        SummonerRepository $summonerRepository,
        SummonerService $summonerService
    ) {
        $this->entityManager = $entityManager;
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
        $this->repository = $championRepository;
        $this->summonerRepository = $summonerRepository;
        $this->summonerService = $summonerService;
    }

    private function getRandomRegionFromList()
    {
        $int = random_int(0, (count($this->list) - 1));
        return $int;
    }

    public function getChampionMasteryById($playerOrTeamId, $region)
    {
        $request = $this->serviceContainer->getParameter('championMastery');
        $request = str_replace('{id}', $playerOrTeamId, $request);
        return $this->guzzle->send($request, $region);
    }

    public function getLeagueRank($playerOrTeamId, $region)
    {
        $request = $this->serviceContainer->getParameter('league')['leagueInfo'];
        $request = str_replace('{id}', $playerOrTeamId, $request);
        return $this->guzzle->send($request, $region);
    }

    public function getMasteryById()
    {
        $listt = $this->getRandomRegionFromList();
        $int = random_int(1 , (count($this->list) - 1));
        $region = $this->list[$listt][0];
        $id = $this->list[$listt][$int];

        $players = $this->getLeaguesPlayersById($id, $region);
        $return = array();

        foreach ($players as $player)
        {
            for ($x = 0; $x <= 5; $x++)
            {
                $data = $this->getChampionMasteryById($player[$x]->playerOrTeamId, $region);

                $summoner = $this->summonerService->getSummonerById($player[$x]->playerOrTeamId, $region);
                $rank = $this->getLeagueRank($player[$x]->playerOrTeamId, $region);

                foreach ($data as $champion)
                {
                    $capsule = array($champion, $summoner, $rank);
                    $return[] = $capsule;
                }
            }
        }

        if (!empty($return))
        {
            return $return[0];
        }
        return $return;
    }

    public function saveRecievedData()
    {
        $data = $this->getMasteryById();

        if (empty($data))
        {
            return false;
        }

        $repository = $this->entityManager->getRepository(Summoner::class);
        $db = $repository->findOneBy(['accountId' => $data[1]->getAccountId()]);

        if ($db == null)
        {
            $this->saveData($data[1]);
            $this->saveData($this->createMastery($data));
            $this->saveData($this->createSummonerLeague($data));
        }
    }

    public function getMasteryListById($id, $championIds, $region)
    {
        $players = $this->getLeaguesPlayersById($id, $region);
        $return = array();

        foreach ($players as $player)
        {
            for ($x = 0; $x <= 10; $x++)
            {
                $request = $this->serviceContainer->getParameter('championMastery');
                $request = str_replace('{id}', $player[$x]->playerOrTeamId, $request);
                $data = $this->guzzle->send($request, $region);

                $summoner = $this->summonerService->getSummonerById($player[$x]->playerOrTeamId, $region);

                foreach ($data as $champion)
                {
                    foreach ($championIds as $championId)
                    {
                        if ($championId == $champion->championId)
                        {
                            $capsule = array($champion, $summoner);
                            $return[] = $capsule;
                        }
                    }
                }
            }
        }
        return $return;
    }

    public function getLeaguesPositionById($id, $region)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('The "id" must be an int');
        }
        $request = $this->serviceContainer->getParameter('league')['leaguePosition'];
        $request = str_replace('{id}', $id, $request);
        $data = $this->guzzle->send($request, $region);
        return $this->createLeagues($data);
    }

    public function getLeaguesPlayersById($id, $region)
    {
        $leagues = $this->getLeaguesPositionById($id, $region);
        $return = array();

        foreach ($leagues as $league)
        {
            $request = $this->serviceContainer->getParameter('league')['leagues'];
            $request = str_replace('{id}', $league->leagueId, $request);
            $player = $this->guzzle->send($request, $region);
            $return[] = $this->createPlayer($player->entries);
        }
        return $return;
    }

    private function saveData($object)
    {
        $this->entityManager->persist($object);
        $this->entityManager->flush();
    }

    public function createLeagues($object)
    {
        $return = array();

        foreach ($object as $leagueData)
        {
            $league = new League();
            $league->setLeagueId($leagueData->leagueId);
            $league->setLeagueName($leagueData->leagueName);
            $league->setTier($leagueData->tier);
            $league->setQueueType($leagueData->queueType);
            $league->setRank($leagueData->rank);
            $league->setPlayerOrTeamId($leagueData->playerOrTeamId);
            $league->setPlayerOrTeamName($leagueData->playerOrTeamName);
            $league->setLeaguePoints($leagueData->leaguePoints);
            $league->setWins($leagueData->wins);
            $league->setLosses($leagueData->losses);
            $league->setVeteran($leagueData->veteran);
            $league->setInactive($leagueData->inactive);
            $league->setFreshBlood($leagueData->freshBlood);
            $league->setHotStreak($leagueData->hotStreak);
            $return[] = $league;
        }
        return $return;
    }

    public function createPlayer($object)
    {
        $return = array();

        foreach ($object as $playerData)
        {
            $player = new Player();
            $player->setplayerOrTeamId($playerData->playerOrTeamId);
            $player->setPlayerOrTeamName($playerData->playerOrTeamName);
            $player->setleaguePoints($playerData->leaguePoints);
            $player->setRank($playerData->rank);
            $player->setWins($playerData->wins);
            $player->setLosses($playerData->losses);
            $player->setVeteran($playerData->veteran);
            $player->setInactive($playerData->inactive);
            $player->setFreshBlood($playerData->freshBlood);
            $player->setHotStreak($playerData->hotStreak);
            $return[] = $player;
        }
        return $return;
    }

    private function createSummonerLeague($object)
    {
        $summonerLeague = new SummonerLeague();
        $summonerLeague->setPlayer($object[1]);
        $summonerLeague->setLeaguePoints($object[2][0]->leaguePoints);
        $summonerLeague->setTier($object[2][0]->tier);
        $summonerLeague->setRank($object[2][0]->rank);
        $summonerLeague->setWins($object[2][0]->wins);
        $summonerLeague->setLosses($object[2][0]->losses);
        $summonerLeague->setInactive($object[2][0]->inactive);
        $summonerLeague->setHotStreak($object[2][0]->hotStreak);
        return $summonerLeague;
    }

    private function createMastery($masteryData)
    {
        $mastery = new Mastery();
        $mastery->setPlayer($masteryData[1]);
        $mastery->setChampionId($masteryData[0]->championId);
        $mastery->setChampionLevel($masteryData[0]->championLevel);
        $mastery->setChampionPoints($masteryData[0]->championPoints);
        $mastery->setLastPlayTime($masteryData[0]->lastPlayTime);
        $mastery->setChampionPointsSinceLastLevel($masteryData[0]->championPointsSinceLastLevel);
        $mastery->setChampionPointsUntilNextLevel($masteryData[0]->championPointsUntilNextLevel);
        $mastery->setChestGranted($masteryData[0]->chestGranted);
        $mastery->setTokensEarned($masteryData[0]->tokensEarned);
        return $mastery;
    }

}