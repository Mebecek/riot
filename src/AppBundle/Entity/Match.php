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
    private $gameId;

    /**
     * @var integer
     */
    private $gameDuration;

    /**
     * @var integer
     */
    private $seasonId;

    /**
     * @var string
     */
    private $gameMode;

    /**
     * @var array
     */
    private $team;

    /**
     * @var string
     */
    private $platformId;

    /**
     * @var array
     */
    private $participantIdentities;

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
     * @return array
     */
    public function getTeam(): array
    {
        return $this->team;
    }

    /**
     * @param array
     */
    public function setTeam(array $team)
    {
        $this->teams = $team;
    }

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
     * @return mixed
     */
    public function getParticipantIdentities()
    {
        return $this->participantIdentities;
    }

    /**
     * @param mixed $participantIdentities
     */
    public function setParticipantIdentities($participantIdentities)
    {
        $this->participantIdentities = $participantIdentities;
    }


}