<?php

namespace App\Form;

use App\Entity\Message;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

use Symfony\Component\Form\Extension\Core\Type\TextareaType;

use Symfony\Component\OptionsResolver\OptionsResolver;

class ContactFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'attr' => array(
                    'class' => 'form_name',
                    'placehorder' => "Enter name..."
                ),
            ])
            ->add('email', TextType::class, [
                'attr' => array(
                    //'class' => '',
                    'placehorder' => "Enter email..."
                ),
                //'label' => false
            ])
            ->add('text', TextareaType::class, [
                'attr' => array(
                    //'class' => '',
                    'placehorder' => "Enter message..."
                ),
                //'label' => false
            ])
            //->add('user')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Message::class,
        ]);
    }
}
