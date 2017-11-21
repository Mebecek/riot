<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace AppBundle\Controller\Service;

use AppBundle\Controller\Classes\GuzzleHttpClient;
use AppBundle\Repository\ChampionRepository;
use Psr\Log\InvalidArgumentException;
use AppBundle\Entity\Champion;
use Symfony\Component\DependencyInjection\ContainerInterface;

class ChampionService
{
    /**
     * @var GuzzleHttpClient
     */
    private $guzzle;

    /**
     * @var ContainerInterface
     */
    private $serviceContainer;

    /**
     * @var ChampionRepository
     */
    private $repository;

    /**
     * Constructor
     * @param GuzzleHttpClient $guzzle
     * @param ContainerInterface $serviceContainer
     */
    public function __construct(GuzzleHttpClient $guzzle, ContainerInterface $serviceContainer, ChampionRepository $championRepository) {
        $this->guzzle = $guzzle;
        $this->serviceContainer = $serviceContainer;
        $this->repository = $championRepository;
    }

    /**
     * Retrieves all the champions
     *
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return array
     */
    public function getChampions($region, $tags = 'all')
    {
        $request = $this->serviceContainer->getParameter('champions');

        if ($this->repository->getRepository()->findAll() == null)
        {
            if ($tags == null) {
                $champions = $this->guzzle->send($request, $region);
            } else {
                $champions = $this->guzzle->send($request, $region, array('tags' => $tags));
            }
            return $this->createChampions($champions->data);
        }
        return null;
    }

    /**
     * Champions current version
     *
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return string
     */
    public function getChampionsVersion($region, $tags = 'image')
    {
        $request = $this->serviceContainer->getParameter('champions');

        if ($tags == null) {
            $champions = $this->guzzle->send($request, $region);
        } else {
            $champions = $this->guzzle->send($request, $region, array('tags' => $tags));
        }
        return $champions->version;
    }

    /**
     * Retrieves one champion
     *
     * @param integer $id the id of the champion
     * @param $region string
     * @throws \Symfony\Component\CssSelector\Exception\InternalErrorException
     * @return Champion
     */
    public function getChampionById($id, $region)
    {
        if(!is_int($id)) {
            throw new InvalidArgumentException('The "id" must be an int');
        }
        $request = $this->serviceContainer->getParameter('championById');
        $request = str_replace('{id}', $id, $request);
        $champion = $this->guzzle->send($request, $region);
        return $this->createChampion($champion);
    }

    /**
     * Create an array of champions
     *
     * @param array $champions an array of json object chamions
     * @return array
     */
    private function createChampions($champions)
    {
        $return = array();

        foreach($champions as $champion)
        {
            $createChampion = $this->createChampion($champion);
            $this->saveChampion($createChampion);
            $return[] = $createChampion;
        }
        return $return;
    }

    /**
     * Delete all champion list
     *
     * @return boolean
     */
    public function deleteChampions()
    {
        $champions = $this->repository->getRepository()->findAll();

        foreach($champions as $champion)
        {
            $this->repository->getEM()->remove($champion);
        }
        return true;
    }

    /**
     * Create a champion
     *
     * @param $object \stdClass
     * @return Champion
     */
    private function createChampion($object)
    {
        $champion = new Champion();
        $champion->setChampionId($object->id);
        $champion->setName($object->name);
        $champion->setTitle($object->title);
        $champion->setImage($object->image->full);
        $champion->setAllyTips($object->allytips);
        $champion->setTags($object->tags);
        $champion->setSkins($object->skins);
        $champion->setItems($object->recommended);
        $champion->setLore($object->lore);
        $champion->setPassive($object->passive->image->full);
        $champion->setSpells($object->spells);
        $champion->setStats($object->info);
        return $champion;
    }

    private function saveChampion($champion)
    {
        $this->repository->getEM()->persist($champion);
        $this->repository->getEM()->flush();
    }
}