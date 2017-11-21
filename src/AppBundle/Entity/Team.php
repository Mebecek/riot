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
class Team
{
    /**
     * @var integer
     */
    private $teamId;

    /**
     * @var boolean
     */
    private $win;

    /**
     * @var boolean
     */
    private $firstBlood;

    /**
     * @var boolean
     */
    private $firstTower;

    /**
     * @var boolean
     */
    private $firstInhibitor;

    /**
     * @var boolean
     */
    private $firstBaron;

    /**
     * @var boolean
     */
    private $firstDragon;

    /**
     * @var boolean
     */
    private $firstRiftHerald;

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
     * @return bool
     */
    public function isWin(): bool
    {
        return $this->win;
    }

    /**
     * @param bool $win
     */
    public function setWin(bool $win)
    {
        $this->win = $win;
    }

    /**
     * @return bool
     */
    public function isFirstBlood(): bool
    {
        return $this->firstBlood;
    }

    /**
     * @param bool $firstBlood
     */
    public function setFirstBlood(bool $firstBlood)
    {
        $this->firstBlood = $firstBlood;
    }

    /**
     * @return bool
     */
    public function isFirstTower(): bool
    {
        return $this->firstTower;
    }

    /**
     * @param bool $firstTower
     */
    public function setFirstTower(bool $firstTower)
    {
        $this->firstTower = $firstTower;
    }

    /**
     * @return bool
     */
    public function isFirstInhibitor(): bool
    {
        return $this->firstInhibitor;
    }

    /**
     * @param bool $firstInhibitor
     */
    public function setFirstInhibitor(bool $firstInhibitor)
    {
        $this->firstInhibitor = $firstInhibitor;
    }

    /**
     * @return bool
     */
    public function isFirstBaron(): bool
    {
        return $this->firstBaron;
    }

    /**
     * @param bool $firstBaron
     */
    public function setFirstBaron(bool $firstBaron)
    {
        $this->firstBaron = $firstBaron;
    }

    /**
     * @return bool
     */
    public function isFirstDragon(): bool
    {
        return $this->firstDragon;
    }

    /**
     * @param bool $firstDragon
     */
    public function setFirstDragon(bool $firstDragon)
    {
        $this->firstDragon = $firstDragon;
    }

    /**
     * @return bool
     */
    public function isFirstRiftHerald(): bool
    {
        return $this->firstRiftHerald;
    }

    /**
     * @param bool $firstRiftHerald
     */
    public function setFirstRiftHerald(bool $firstRiftHerald)
    {
        $this->firstRiftHerald = $firstRiftHerald;
    }


}