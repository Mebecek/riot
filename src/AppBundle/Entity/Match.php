<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 22. 9. 2017
 * Time: 12:39
 */

namespace AppBundle\Entity;

/**
 * Match
 */
class Match
{
    /**
     * @var integer
     */
    public $gameId;

    /**
     * @var integer
     */
    public $gameDuration;

    /**
     * @var integer
     */
    public $seasonId;

    /**
     * @var string
     */
    public $gameMode;

    /**
     * @var array
     */
    public $team;

    /**
     * @var string
     */
    public $platformId;

    /**
     * @var array
     */
    public $participant;

    /**
     * @return int
     */
    public function getGameId(): int
    {
        return $this->gameId;
    }

    /**
     * @param int $gameId
     */
    public function setGameId(int $gameId)
    {
        $this->gameId = $gameId;
    }

    /**
     * @return int
     */
    public function getGameDuration(): int
    {
        return $this->gameDuration;
    }

    /**
     * @param int $gameDuration
     */
    public function setGameDuration(int $gameDuration)
    {
        $this->gameDuration = $gameDuration;
    }

    /**
     * @return int
     */
    public function getSeasonId(): int
    {
        return $this->seasonId;
    }

    /**
     * @param int $seasonId
     */
    public function setSeasonId(int $seasonId)
    {
        $this->seasonId = $seasonId;
    }

    /**
     * @return string
     */
    public function getGameMode(): string
    {
        return $this->gameMode;
    }

    /**
     * @param string $gameMode
     */
    public function setGameMode(string $gameMode)
    {
        $this->gameMode = $gameMode;
    }

    /**
     * @return array
     */
    public function getTeam(): array
    {
        return $this->team;
    }

    /**
     * @param array $team
     */
    public function setTeam(array $team)
    {
        $this->team = $team;
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
     * @return array
     */
    public function getParticipant(): array
    {
        return $this->participant;
    }

    /**
     * @param array $participant
     */
    public function setParticipant(array $participant)
    {
        $this->participant = $participant;
    }

}