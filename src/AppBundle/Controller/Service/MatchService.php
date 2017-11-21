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
use AppBundle\Entity\Team;
use AppBundle\Repository\ChampionRepository;
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
     * Constructor
     * @param GuzzleHttpClient $guzzle
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(GuzzleHttpClient $guzzle, ContainerInterface $serviceContainer, ChampionRepository $championRepository) {
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
        $this->repository = $championRepository;
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
        $request = str_replace('{id}', $id, $request);
        $champion = $this->guzzle->send($request, $region);
        $arr = array();

        $i = 0;
        foreach ($champion->matches as $match)
        {
            if ($i >= 20) {
                return $arr;
            } else {
                $i += 1;
                $arr[] = $this->getMatchGameInfoById($match->gameId, $region);
            }
        }
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

       $teams = [];

       foreach ($object->teams as $teamData)
       {
           $team = new Team();
           $team->setTeamId($teamData->teamId);
           $team->setWin($teamData->win);
           $team->setFirstBlood($teamData->firstBlood);
           $teams[] = $team;
       }

       $match->setTeam($teams);
       return $match;
    }

}