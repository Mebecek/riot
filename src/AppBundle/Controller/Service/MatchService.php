<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace AppBundle\Controller\Service;

use AppBundle\Controller\Classes\GuzzleHttpClient;
use AppBundle\Entity\Match;
use AppBundle\Entity\Participant;
use AppBundle\Entity\Team;
use ChampionBundle\Model\Repository\ChampionRepository;
use AppBundle\Repository\SummonerRepository;
use Psr\Log\InvalidArgumentException;
use Symfony\Component\DependencyInjection\ContainerInterface;

class MatchService
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
     * @var ChampionRepository
     */
    private $repository;

    /**
     * @var SummonerRepository
     */
    private $summonerRepository;

    /**
     * @var array
     */
    private $staticIds =
        [
            [38586683, 40142082, 206044748, 32384848, 202241911, 22543663]
        ];

    /**
     * Constructor
     * @param GuzzleHttpClient $guzzle
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(
        GuzzleHttpClient $guzzle,
        ContainerInterface $serviceContainer,
        ChampionRepository $championRepository,
        SummonerRepository $summonerRepository
    ) {
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
        $this->repository = $championRepository;
        $this->summonerRepository = $summonerRepository;
    }

    public function getMatchGameInfoById($id, $region)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('The "id" must be an int');
        }
        $request = $this->serviceContainer->getParameter('match')['matchGameInfo'];
        $request = str_replace('{id}', $id, $request);
        $gameInfo = $this->guzzle->send($request, $region);
        return $this->createMatch($gameInfo);
    }

    /**
     * Retrieves one champion
     *
     * @param integer $id the id of the champion
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return array
     */
    public function getMatchesBySummonerId($id, $region)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('The "id" must be an int');
        }
        $request = $this->serviceContainer->getParameter('match')['matchGames'];

        $summonerRepo = $this->summonerRepository->getRepository()->findAll();
        if ($summonerRepo == null || $summonerRepo <= 100)
        {
            $id = $this->staticIds[random_int(0, (count($this->staticIds) - 1))][random_int(0, (count($this->staticIds[0]) - 1))];
        }

        $request = str_replace('{id}', $id, $request);
        $champion = $this->guzzle->send($request, $region);
        $arr = array();

        $i = 0;
        foreach ($champion->matches as $match)
        {
            if ($i < 2)
            {
                $arr[] = $this->getMatchGameInfoById($match->gameId, $region);
                $i += 1;
            }
        }
        return $arr;
    }

    public function getMatchedPlayers($id, $championsId, $region)
    {
        $matches = $this->getFindMatchListById($id, $region);
        $arr = array();
        $array = array();

        foreach ($matches as $match)
        {
            foreach ($match as $matchData)
            {
                $arr[] = $matchData;
            }
        }
        return $arr;
    }

    public function getFindMatchListById($id, $region)
    {
        $matches = $this->getMatchesBySummonerId($id, $region);
        $arr = [];

        foreach ($matches as $participant)
        {
            foreach ($participant->participant as $player)
            {
                try {
                    $arr[] = $this->getMatchesBySummonerId($player->accountId, $region);
                } catch (\Exception $e) {

                }
            }
        }
        return $arr;
    }

    public function getParticipantsFromList($id, $championsId, $region)
    {
        $matches = $this->getMatchedPlayers($id, $championsId, $region);
        $arr = [];

        foreach ($matches as $participant)
        {
            foreach ($participant->participant as $player)
            {
                try {
                    $arr[] = $player;
                } catch (\Exception $e) {

                }
            }
        }

        return $arr;
    }

    public function getParticipantByChampionFilter($id, $championsId, $region)
    {
        $participants = $this->getParticipantsFromList($id, $championsId, $region);
        $arr = [];

        foreach ($participants as $participant)
        {
            if (in_array($participant->championId, $championsId)) {
                $arr[] = $participant;
            }
        }
        return dump($arr);
    }

    private function createMatches($matches)
    {
        $return = array();

        foreach($matches as $match)
        {
            $createMatch = $this->createMatch($match);
            $return[] = $createMatch;
        }
        return $return;
    }

    private function createMatch($object)
    {
       $match = new Match();
       $match->setGameId($object->gameId);
       $match->setPlatformId($object->platformId);
       $match->setGameDuration($object->gameDuration);
       $match->setSeasonId($object->seasonId);
       $match->setGameMode($object->gameMode);

       $array = [];

       foreach ($object->teams as $teamData)
       {
           $team = new Team();
           $team->setTeamId($teamData->teamId);
           $team->setWin($teamData->win);
           $team->setFirstBlood($teamData->firstBlood);
           $team->setFirstTower($teamData->firstTower);
           $team->setFirstInhibitor($teamData->firstInhibitor);
           $team->setFirstBaron($teamData->firstBaron);
           $team->setFirstDragon($teamData->firstDragon);
           $team->setFirstRiftHerald($teamData->firstRiftHerald);
           $array[] = $team;
       }

       $match->setTeam($array);
       $array = [];

        for ($x = 0; $x <= (count($object->participants) - 1); $x++)
        {
           $participant = new Participant();
           $participant->setParticipantId($object->participants[$x]->participantId);
           $participant->setTeamId($object->participants[$x]->teamId);
           $participant->setChampionId($object->participants[$x]->championId);
           $participant->setSpell1Id($object->participants[$x]->spell1Id);
           $participant->setSpell2Id($object->participants[$x]->spell2Id);
           $participant->setHighestAchievedSeasonTier($object->participants[$x]->highestAchievedSeasonTier);
           $participant->setRole($object->participants[$x]->timeline->role);
           $participant->setLane($object->participants[$x]->timeline->lane);
           $participant->setAccountId($object->participantIdentities[$x]->player->accountId);
           $participant->setSummoner($object->participantIdentities[$x]->player->summonerId);
           $participant->setSummonerName($object->participantIdentities[$x]->player->summonerName);
           $participant->setPlatformid($object->participantIdentities[$x]->player->platformId);
           $participant->setParticipantId($object->participantIdentities[$x]->participantId);
           $array[] = $participant;
       }

       $match->setParticipant($array);

       return $match;
    }

}