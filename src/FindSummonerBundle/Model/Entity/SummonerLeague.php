<?php

namespace FindSummonerBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SummonerLeague
 *
 * @ORM\Entity()
 * @ORM\Table()
 */
class SummonerLeague
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
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Summoner")
     * @ORM\JoinColumn(nullable=false)
     */
    public $player;

    /**
     * @var string
     *
     * @ORM\Column(name="tier", type="string")
     */
    private $tier;

    /**
     * @var string
     *
     * @ORM\Column(name="rank", type="string")
     */
    private $rank;

    /**
     * @var integer
     *
     * @ORM\Column(name="league_points", type="integer")
     */
    private $leaguePoints;

    /**
     * @var integer
     *
     * @ORM\Column(name="wins", type="integer")
     */
    private $wins;

    /**
     * @var integer
     *
     * @ORM\Column(name="losses", type="integer")
     */
    private $losses;

    /**
     * @var boolean
     *
     * @ORM\Column(name="inactive", type="boolean")
     */
    private $inactive;

    /**
     * @var boolean
     *
     * @ORM\Column(name="hot_streak", type="boolean")
     */
    private $hotStreak;

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
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param mixed $player
     */
    public function setPlayer($player)
    {
        $this->player = $player;
    }



    /**
     * @return string
     */
    public function getTier(): string
    {
        return $this->tier;
    }

    /**
     * @param string $tier
     */
    public function setTier(string $tier)
    {
        $this->tier = $tier;
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


}