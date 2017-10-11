<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 18. 7. 2017
 * Time: 10:29
 */

namespace AppBundle\Controller\Form;

use AppBundle\Controller\Constant\Region;
use AppBundle\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VerificationForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nickname')
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