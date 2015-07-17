<?php

namespace Dadamssg\DemoApp\Bundle\UserBundle\Form\Type;

use Dadamssg\DemoApp\Model\User\Command\RegisterUser;
use Rhumsaa\Uuid\Uuid;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RegisterUserType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $notMapped = ['mapped' => false];

        $builder
            ->add('email', null, $notMapped)
            ->add('password', null, $notMapped);
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(
            [
                'validation_groups' => false,
                'allow_extra_fields' => true,
                'empty_data' => function (FormInterface $form) {
                    $userId = Uuid::uuid4()->toString();
                    return new RegisterUser(
                        $userId,
                        $userId,
                        $form->get('email')->getData(),
                        $form->get('password')->getData()
                    );
                }
            ]
        );
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'user';
    }
}