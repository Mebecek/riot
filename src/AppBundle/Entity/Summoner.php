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
    protected $id;

    /**
     * @var integer
     *
     * @ORM\Column(name="summoner_id", type="integer")
     */
    protected $summonerId;

    /**
     * @var integer
     *
     * @ORM\Column(name="account_id", type="integer")
     */
    protected $accountId;

    /**
     * @var string
     *
     * @ORM\Column(name="region", type="string", nullable=true)
     */
    protected $region;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    protected $name;

    /**
     * @var integer
     *
     * @ORM\Column(name="profile_icon_id", type="integer")
     */
    protected $profileIconId;

    /**
     * @var float
     *
     * @ORM\Column(name="revision_date", type="float")
     */
    protected $revisionDate;

    /**
     * $var integer
     *
     * @ORM\Column(name="summoner_level", type="integer")
     */
    protected $summonerLevel;

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
     * @return string
     */
    public function getRegion(): string
    {
        return $this->region;
    }

    /**
     * @param string $region
     */
    public function setRegion(string $region)
    {
        $this->region = $region;
    }
}