<?php

namespace App\Form\Consoles;

use App\Entity\Console;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddConsoleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('imageFile', FileType::class, array(
                'required' => true,
                'label' => 'consoles.form.thumbnail.label',
                'row_attr' => array(
                    'class' => 'col-sm-6 col-12'
                ),
            ))
            ->add('submit', SubmitType::class, array(
                'label' => 'form.button.create',
                'row_attr' => array(
                    'class' => 'col-sm-12 text-center mt-3 '
                ),
                'attr' => array(
                    'class' => 'btn-lg btn btn-primary',
                ),
            ))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Console::class,
        ]);
    }

    public function getParent()
    {
        return AbstractConsoleType::class;
    }
}
