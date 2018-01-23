<?php

namespace ChampionBundle\Model\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Champion
 *
 * @ORM\Entity(repositoryClass="ChampionBundle\Model\Repository\ChampionRepository")
 * @ORM\Table()
 */
class Champion
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
     * @var integer
     *
     * @ORM\Column(name="champion_id", type="integer")
     *
     */
    private $championId;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string")
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string")
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="image", type="string")
     */
    private $image;

    /**
     * @var array
     *
     * @ORM\Column(name="tags", type="json_array")
     */
    private $tags;

    /**
     * @var array
     *
     * @ORM\Column(name="skins", type="json_array")
     */
    private $skins;

    /**
     * @var array
     *
     * @ORM\Column(name="items", type="json_array")
     */
    private $items;

    /**
     * @var string
     *
     * @ORM\Column(name="lore", type="text")
     */
    private $lore;

    /**
     * @var array
     *
     * @ORM\Column(name="allyTips", type="json_array")
     */
    private $allytips;

    /**
     * @var string
     *
     * @ORM\Column(name="passive", type="string")
     */
    private $passive;

    /**
     * @var array
     *
     * @ORM\Column(name="spells", type="json_array")
     */
    private $spells;

    /**
     * @var
     *
     * @ORM\Column(name="stats", type="json_array")
     */
    private $stats;

    /**
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return int
     */
    public function getChampionId()
    {
        return $this->championId;
    }

    /**
     * @param int $championId
     */
    public function setChampionId($championId)
    {
        $this->championId = $championId;
    }

    /**
     * @return string
     */
    public function getImage()
    {
        return $this->image;
    }

    /**
     * @param string $image
     */
    public function setImage($image)
    {
        $this->image = $image;
    }

    /**
     * @return array
     */
    public function getTags(): array
    {
        return $this->tags;
    }

    /**
     * @param array $tags
     * @return array
     */
    public function setTags(array $tags)
    {
        foreach ($tags as $tag) {
            if (!$tag) return [];
            $this->tags[] = $tag;
        }
        return [];
    }

    /**
     * @return array
     */
    public function getSkins(): array
    {
        return $this->skins;
    }

    /**
     * @param array $skins
     * @return array
     */
    public function setSkins(array $skins)
    {
        /*foreach ($skins as $skin) {
            if (!$skin) return [];
            $this->skins[] = ["skin" => $skin->num, "name" => $skin->name];
        }
        return [];*/
        $this->skins = $skins;
    }

    /**
     * @return array
     */
    public function getItems(): array
    {
        return $this->items;
    }

    /**
     * @param array $items
     */
    public function setItems(array $items)
    {
        $this->items = $items;
    }

    /**
     * @return string
     */
    public function getLore(): string
    {
        return $this->lore;
    }

    /**
     * @param string $lore
     */
    public function setLore(string $lore)
    {
        $this->lore = $lore;
    }

    /**
     * @return array
     */
    public function getAllytips(): array
    {
        return $this->allytips;
    }

    /**
     * @param array $allytips
     * @return array
     */
    public function setAllytips(array $allytips)
    {
        foreach ($allytips as $tip) {
            if (!$tip) return [];
            $this->allytips[] = $tip;
        }
        return [];
    }

    /**
     * @return string
     */
    public function getPassive(): string
    {
        return $this->passive;
    }

    /**
     * @param string $passive
     */
    public function setPassive(string $passive)
    {
        $this->passive = $passive;
    }

    /**
     * @return array
     */
    public function getSpells(): array
    {
        return $this->spells;
    }

    /**
     * @param array $spells
     */
    public function setSpells(array $spells)
    {
        $this->spells = $spells;
    }

    /**
     * @return mixed
     */
    public function getStats()
    {
        return $this->stats;
    }

    /**
     * @param mixed $stats
     */
    public function setStats($stats)
    {
        $this->stats[] = $stats->attack;
        $this->stats[] = $stats->defense;
        $this->stats[] = $stats->magic;
        $this->stats[] = $stats->difficulty;
    }


}