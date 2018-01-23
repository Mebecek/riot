<?php

namespace FindSummonerBundle\Model\Form;

use AppBundle\Controller\Constant\Region;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\RangeType;
use Symfony\Component\Form\FormBuilderInterface;

class ChampionFindType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('champion_list', HiddenType::class)
            ->add('champion_list_stranger', HiddenType::class)
            ->add('points', RangeType::class)
            ->add('region', ChoiceType::class, array(
                'choices'  => array(
                    'EUNE' => Region::EUNE,
                    'EUW' => Region::EUW,
                    'NA' => Region::NA,
                    'OCE' => Region::OCE,
                    'KR' => Region::KR,
                    'RU' => Region::RU,
                    'TR' => Region::TR,
                    'BR' => Region::BR)));
    }
}