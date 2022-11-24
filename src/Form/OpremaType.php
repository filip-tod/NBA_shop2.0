<?php

namespace App\Form;

use App\Entity\Oprema;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OpremaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('cijena')
            ->add('vrsta')
            ->add('velicina')
            ->add('boja')
            ->add('igrac')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Oprema::class,
        ]);
    }
}
