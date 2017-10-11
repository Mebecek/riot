<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:49
 */

namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


class Summoner
{
    /**
     * @var integer
     */
    private $summonerId;

    /**
     * @var integer
     *
     */
    private $accountId;

    /**
     * @var string
     */
    private $name;

    /**
     * @var integer
     */
    private $profileIconId;

    /**
     * @var float
     */
    private $revisionDate;

    /**
     * $var integer
     */
    private $summonerLevel;

    /**
     * @return int
     */
    public function getSummonerId(): int
    {
        return $this->summonerId;
    }

    /**
     * @param int $summonerId
     */
    public function setSummonerId(int $summonerId)
    {
        $this->summonerId = $summonerId;
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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name)
    {
        $this->name = $name;
    }

    /**
     * @return int
     */
    public function getProfileIconId(): int
    {
        return $this->profileIconId;
    }

    /**
     * @param int $profileIconId
     */
    public function setProfileIconId(int $profileIconId)
    {
        $this->profileIconId = $profileIconId;
    }

    /**
     * @return mixed
     */
    public function getSummonerLevel()
    {
        return $this->summonerLevel;
    }

    /**
     * @param mixed $summonerLevel
     */
    public function setSummonerLevel($summonerLevel)
    {
        $this->summonerLevel = $summonerLevel;
    }

    /**
     * @return float
     */
    public function getRevisionDate(): float
    {
        return $this->revisionDate;
    }

    /**
     * @param float $revisionDate
     */
    public function setRevisionDate(float $revisionDate)
    {
        $this->revisionDate = $revisionDate;
    }

}