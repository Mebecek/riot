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
    private $participantId;

    /**
     * @var integer
     */
    private $teamId;

    /**
     * @var integer
     */
    private $championId;

    /**
     * @var integer
     */
    private $spell1Id;

    /**
     * @var integer
     */
    private $spell2Id;

    /**
     * @var string
     */
    private $highestAchievedSeasonTier;

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


}