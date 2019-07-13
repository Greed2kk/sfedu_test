<?php

namespace App\Form;

use App\Entity\Subdivision;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Expression\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
class SubdivisionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, ['label' => 'title'])
            ->add('address', TextType::class, ['label' => 'address'])
            ->add('director', TextType::class, ['label' => 'director'])
            ->add('save', SubmitType::class, ['attr' => ['class' => 'save']])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Subdivision::class,
        ]);
    }
}
