<?php

namespace App\Form\Search;

use App\Entity\Game;
use App\Entity\Search\Item;
use App\Repository\GameRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ItemType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class,[
                'required' => false,
                'label' => 'items.form.name.label',
                'attr' => [
                    'placeholder' => 'items.form.name.placeholder',
                ],
                'row_attr' => [
                    'class' => 'col-sm-5'
                ],
            ])
            ->add('game', EntityType::class, [
                'required' => false,
                'label' => 'items.form.game.label',
                'placeholder' => 'items.form.game.placeholder',
                'class' => Game::class,
                'choice_label' => 'name',
                'query_builder' => function(GameRepository $gameRepository){
                    return $gameRepository->findAllSortByProperty('name');
                },
                'row_attr' => [
                    'class' => 'col-sm-5'
                ],
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'form.button.filter',
                'attr' => [
                    'class' => 'btn-lg btn-primary btn',
                ],
                'row_attr' => [
                    'class' => 'col-sm-2 text-center m-auto'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);
    }
}
