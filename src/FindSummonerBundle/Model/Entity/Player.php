<?php

namespace FindSummonerBundle\Model\Entity;

/**
 * Champion
 */
class Player
{
    /**
     * @var integer
     */
    public $playerOrTeamId;

    /**
     * @var string
     */
    public $playerOrTeamName;

    /**
     * @var integer
     */
    public $leaguePoints;

    /**
     * @var string
     */
    public $rank;

    /**
     * @var integer
     */
    public $wins;

    /**
     * @var integer
     */
    public $losses;

    /**
     * @var boolean
     */
    public $veteran;

    /**
     * @var boolean
     */
    public $inactive;

    /**
     * @var boolean
     */
    public $freshBlood;

    /**
     * @var boolean
     */
    public $hotStreak;

    /**
     * @return int
     */
    public function getPlayerOrTeamId(): int
    {
        return $this->playerOrTeamId;
    }

    /**
     * @param int $playerOrTeamId
     */
    public function setPlayerOrTeamId(int $playerOrTeamId)
    {
        $this->playerOrTeamId = $playerOrTeamId;
    }

    /**
     * @return string
     */
    public function getPlayerOrTeamName(): string
    {
        return $this->playerOrTeamName;
    }

    /**
     * @param string $playerOrTeamName
     */
    public function setPlayerOrTeamName(string $playerOrTeamName)
    {
        $this->playerOrTeamName = $playerOrTeamName;
    }

    /**
     * @return int
     */
    public function getLeaguePoints(): int
    {
        return $this->leaguePoints;
    }

    /**
     * @param int $leaguePoints
     */
    public function setLeaguePoints(int $leaguePoints)
    {
        $this->leaguePoints = $leaguePoints;
    }

    /**
     * @return int
     */
    public function getWins(): int
    {
        return $this->wins;
    }

    /**
     * @param int $wins
     */
    public function setWins(int $wins)
    {
        $this->wins = $wins;
    }

    /**
     * @return int
     */
    public function getLosses(): int
    {
        return $this->losses;
    }

    /**
     * @param int $losses
     */
    public function setLosses(int $losses)
    {
        $this->losses = $losses;
    }

    /**
     * @return bool
     */
    public function isVeteran(): bool
    {
        return $this->veteran;
    }

    /**
     * @param bool $veteran
     */
    public function setVeteran(bool $veteran)
    {
        $this->veteran = $veteran;
    }

    /**
     * @return bool
     */
    public function isFreshBlood(): bool
    {
        return $this->freshBlood;
    }

    /**
     * @param bool $freshBlood
     */
    public function setFreshBlood(bool $freshBlood)
    {
        $this->freshBlood = $freshBlood;
    }

    /**
     * @return bool
     */
    public function isHotStreak(): bool
    {
        return $this->hotStreak;
    }

    /**
     * @param bool $hotStreak
     */
    public function setHotStreak(bool $hotStreak)
    {
        $this->hotStreak = $hotStreak;
    }

    /**
     * @return string
     */
    public function getRank(): string
    {
        return $this->rank;
    }

    /**
     * @param string $rank
     */
    public function setRank(string $rank)
    {
        $this->rank = $rank;
    }

    /**
     * @return bool
     */
    public function isInactive(): bool
    {
        return $this->inactive;
    }

    /**
     * @param bool $inactive
     */
    public function setInactive(bool $inactive)
    {
        $this->inactive = $inactive;
    }


}