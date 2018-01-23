<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22. 9. 2017
 * Time: 12:39
 */

namespace AppBundle\Entity;

/**
 * Participant
 */
class Participant
{
    /**
     * @var integer
     */
    public $participantId;

    /**
     * @var integer
     */
    public $teamId;

    /**
     * @var integer
     */
    public $championId;

    /**
     * @var integer
     */
    public $spell1Id;

    /**
     * @var integer
     */
    public $spell2Id;

    /**
     * @var string
     */
    public $highestAchievedSeasonTier;

    /**
     * @var string
     */
    public $role;

    /**
     * @var string
     */
    public $lane;

    /**
     * @var integer
     */
    public $accountId;

    /**
     * @var string
     */
    public $platformId;

    /**
     * @var string
     */
    public $summonerName;

    /**
     * @var integer
     */
    public $summoner;

    /**
     * @return int
     */
    public function getParticipantId(): int
    {
        return $this->participantId;
    }

    /**
     * @param int $participantId
     */
    public function setParticipantId(int $participantId)
    {
        $this->participantId = $participantId;
    }

    /**
     * @return int
     */
    public function getTeamId(): int
    {
        return $this->teamId;
    }

    /**
     * @param int $teamId
     */
    public function setTeamId(int $teamId)
    {
        $this->teamId = $teamId;
    }

    /**
     * @return int
     */
    public function getChampionId(): int
    {
        return $this->championId;
    }

    /**
     * @param int $championId
     */
    public function setChampionId(int $championId)
    {
        $this->championId = $championId;
    }

    /**
     * @return int
     */
    public function getSpell1Id(): int
    {
        return $this->spell1Id;
    }

    /**
     * @param int $spell1Id
     */
    public function setSpell1Id(int $spell1Id)
    {
        $this->spell1Id = $spell1Id;
    }

    /**
     * @return int
     */
    public function getSpell2Id(): int
    {
        return $this->spell2Id;
    }

    /**
     * @param int $spell2Id
     */
    public function setSpell2Id(int $spell2Id)
    {
        $this->spell2Id = $spell2Id;
    }

    /**
     * @return string
     */
    public function getHighestAchievedSeasonTier(): string
    {
        return $this->highestAchievedSeasonTier;
    }

    /**
     * @param string $highestAchievedSeasonTier
     */
    public function setHighestAchievedSeasonTier(string $highestAchievedSeasonTier)
    {
        $this->highestAchievedSeasonTier = $highestAchievedSeasonTier;
    }

    /**
     * @return string
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * @param string $role
     */
    public function setRole(string $role)
    {
        $this->role = $role;
    }

    /**
     * @return string
     */
    public function getLane(): string
    {
        return $this->lane;
    }

    /**
     * @param string $lane
     */
    public function setLane(string $lane)
    {
        $this->lane = $lane;
    }

    /**
     * @return int
     */
    public function getAccountId(): int
    {
        return $this->accountId;
    }

    /**
     * @param int $accountId
     */
    public function setAccountId(int $accountId)
    {
        $this->accountId = $accountId;
    }

    /**
     * @return string
     */
    public function getPlatformId(): string
    {
        return $this->platformId;
    }

    /**
     * @param string $platformId
     */
    public function setPlatformId(string $platformId)
    {
        $this->platformId = $platformId;
    }

    /**
     * @return string
     */
    public function getSummonerName(): string
    {
        return $this->summonerName;
    }

    /**
     * @param string $summonerName
     */
    public function setSummonerName(string $summonerName)
    {
        $this->summonerName = $summonerName;
    }

    /**
     * @return int
     */
    public function getSummoner(): int
    {
        return $this->summoner;
    }

    /**
     * @param int $summoner
     */
    public function setSummoner(int $summoner)
    {
        $this->summoner = $summoner;
    }


}