<?php

namespace FindSummonerBundle\Model\Entity;

use AppBundle\Entity\Summoner;
use Doctrine\ORM\Mapping as ORM;
use UserBundle\Model\Entity\User;

/**
 * Champion
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="FindSummonerBundle\Model\Repository\MasteryRepository")
 */
class Mastery
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var Summoner
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Summoner")
     * @ORM\JoinColumn(referencedColumnName="id")
     */
    public $player;

    /**
     * @var integer
     *
     * @ORM\Column(name="champion_id", type="integer")
     */
    public $championId;

    /**
     * @var integer
     *
     * @ORM\Column(name="champion_level", type="integer")
     */
    public $championLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="champion_points", type="integer")
     */
    public $championPoints;

    /**
     * @var float
     *
     * @ORM\Column(name="last_play_time", type="float")
     */
    public $lastPlayTime;

    /**
     * @var integer
     *
     * @ORM\Column(name="champion_points_since_last_level", type="integer")
     */
    public $championPointsSinceLastLevel;

    /**
     * @var integer
     *
     * @ORM\Column(name="champion_points_until_next_level", type="integer")
     */
    public $championPointsUntilNextLevel;

    /**
     * @var boolean
     *
     * @ORM\Column(name="chest_granted", type="boolean")
     */
    public $chestGranted;

    /**
     * @var integer
     *
     * @ORM\Column(name="tokens_earned", type="integer")
     */
    public $tokensEarned;

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id)
    {
        $this->id = $id;
    }

    /**
     * @return Summoner
     */
    public function getPlayer(): Summoner
    {
        return $this->player;
    }

    /**
     * @param Summoner $player
     */
    public function setPlayer(Summoner $player)
    {
        $this->player = $player;
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
    public function getChampionLevel(): int
    {
        return $this->championLevel;
    }

    /**
     * @param int $championLevel
     */
    public function setChampionLevel(int $championLevel)
    {
        $this->championLevel = $championLevel;
    }

    /**
     * @return int
     */
    public function getChampionPoints(): int
    {
        return $this->championPoints;
    }

    /**
     * @param int $championPoints
     */
    public function setChampionPoints(int $championPoints)
    {
        $this->championPoints = $championPoints;
    }

    /**
     * @return int
     */
    public function getChampionPointsSinceLastLevel(): int
    {
        return $this->championPointsSinceLastLevel;
    }

    /**
     * @param int $championPointsSinceLastLevel
     */
    public function setChampionPointsSinceLastLevel(int $championPointsSinceLastLevel)
    {
        $this->championPointsSinceLastLevel = $championPointsSinceLastLevel;
    }

    /**
     * @return int
     */
    public function getChampionPointsUntilNextLevel(): int
    {
        return $this->championPointsUntilNextLevel;
    }

    /**
     * @param int $championPointsUntilNextLevel
     */
    public function setChampionPointsUntilNextLevel(int $championPointsUntilNextLevel)
    {
        $this->championPointsUntilNextLevel = $championPointsUntilNextLevel;
    }

    /**
     * @return bool
     */
    public function isChestGranted(): bool
    {
        return $this->chestGranted;
    }

    /**
     * @param bool $chestGranted
     */
    public function setChestGranted(bool $chestGranted)
    {
        $this->chestGranted = $chestGranted;
    }

    /**
     * @return int
     */
    public function getTokensEarned(): int
    {
        return $this->tokensEarned;
    }

    /**
     * @param int $tokensEarned
     */
    public function setTokensEarned(int $tokensEarned)
    {
        $this->tokensEarned = $tokensEarned;
    }

    /**
     * @return float
     */
    public function getLastPlayTime(): float
    {
        return $this->lastPlayTime;
    }

    /**
     * @param float $lastPlayTime
     */
    public function setLastPlayTime(float $lastPlayTime)
    {
        $this->lastPlayTime = $lastPlayTime;
    }


}