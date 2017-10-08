<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 24. 7. 2017
 * Time: 14:15
 */

namespace AppBundle\Controller\Form;

use AppBundle\Entity\Product;
use AppBundle\Entity\ProductPicture;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('perex')
            ->add('text')
            ->add('imageFile', FileType::class, ['multiple'=>true, 'required'=>false])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}