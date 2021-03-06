<?php

namespace App\Form\Games\GameCharacters;

use App\Entity\GameCharacter;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class AddGameCharacterType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('uploadThumbnail', FileType::class, [
                'required' => true,
                'label' => 'game_characters.form.thumbnail.label',
                'row_attr' => [
                    'class' => 'col-sm-6 col-12'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.button.create',
                'row_attr' => [
                    'class' => 'col-sm-12 text-center mt-3 '
                ],
                'attr' => [
                    'class' => 'btn-lg btn btn-primary',
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => GameCharacter::class,
        ]);
    }

    public function getParent()
    {
        return AbstractGameCharacterType::class;
    }
}
