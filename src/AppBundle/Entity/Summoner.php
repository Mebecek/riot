<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:49
 */

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Summoner
 *
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SummonerRepository")
 * @ORM\Table()
 */
class Summoner
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
     * @ORM\OneToOne(targetEntity="User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user;

    /**
     * @var integer
     *
     * @ORM\Column(name="summoner_id", type="integer")
     */
    private $summonerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    private $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="profile_icon_id", type="integer")
     */
    private $profileIconId;

    /**
     * @var float
     *
     * @ORM\Column(name="revision_date", type="float")
     */
    private $revisionDate;

    /**
     * $var integer
     *
     * @ORM\Column(name="summoner_level", type="integer")
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