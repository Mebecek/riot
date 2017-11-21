<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 13. 7. 2017
 * Time: 19:53
 */

namespace AppBundle\Controller\Form\Find;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;

class ChampionFindType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('champion_list', HiddenType::class)
            ->add('champion_list_stranger', HiddenType::class);
    }
}