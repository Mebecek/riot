<?php
/**
 * Created by PhpStorm.
 * User: Administrator
 * Date: 19. 7. 2017
 * Time: 10:26
 */

namespace AppBundle\Controller\Form;

use function PHPSTORM_META\type;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class ChangePasswordForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('oldPassword', PasswordType::class);
        $builder->add('newPassword', PasswordType::class);
    }
}