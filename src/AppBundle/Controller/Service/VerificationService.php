<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 12. 9. 2017
 * Time: 17:51
 */

namespace AppBundle\Controller\Service;

use AppBundle\Controller\Classes\Generator;
use AppBundle\Entity\Verification;
use AppBundle\Repository\SummonerRepository;
use AppBundle\Repository\VerificationRepository;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class VerificationService
{
    /**
     * @var Generator
     */
    private $generator;

    /**
     * @var VerificationRepository
     */
    private $repository;

    /**
     * @var TokenStorageInterface
     */
    private $tokenStorage;

    /**
     * @var MasteriesService
     */
    private $masteriesService;

    /**
     * @var SummonerRepository
     */
    private $summonerRepository;

    /**
     * Constructor
     * @param Generator $generator;
     * @param $verificationRepository $verificationRepository
     * @param TokenStorageInterface $tokenStorage
     * @param MasteriesService $masteriesService
     * @param SummonerRepository $summonerRepository
     */
    public function __construct(
        Generator $generator,
        VerificationRepository $verificationRepository,
        TokenStorageInterface $tokenStorage,
        MasteriesService $masteriesService,
        SummonerRepository $summonerRepository)
    {
        $this->generator = $generator;
        $this->repository = $verificationRepository;
        $this->tokenStorage = $tokenStorage;
        $this->masteriesService = $masteriesService;
        $this->summonerRepository = $summonerRepository;
    }

    public function getVerification()
    {
        $status = $this->repository->getRepository()->findOneBy(['user' => $this->tokenStorage->getToken()->getUser()]);

        if (!$status)
        {
            $verify = $this->createVerification();
            $this->saveVerification($verify);
            return $verify;
        }
        return $status;
    }

    public function checkVerification($summonerId, $region)
    {
        $masteries = $this->masteriesService->getMasteriesById($summonerId, $region);
        $code = $this->getVerification();

        foreach ($masteries as $mastery)
        {
            if ($mastery->getName() === $code->getVerificationKey())
            {
                return true;
            }
        }
        return false;
    }

    public function updateVerification($object)
    {
        $verification = $this->repository->getRepository()->find($object);
        //$user = $this->summonerRepository->getRepository()->find($this->tokenStorage->getToken()->getUser());
        //$user->setNickname($user);
        $verification->setVerified(true);
        $this->repository->getEM()->flush();
    }

    /**
     * Create a champion
     *
     * @return Verification
     */
    private function createVerification()
    {
        $verification = new Verification();
        $verification->setVerificationKey($this->generator->getRandomString());
        $verification->setUser($this->tokenStorage->getToken()->getUser());
        $verification->setVerified(false);
        return $verification;
    }

    /**
     * @param $verification
     */
    private function saveVerification($verification)
    {
        $this->repository->getEM()->persist($verification);
        $this->repository->getEM()->flush();
    }
}