<?php

namespace App\Form;

use App\Entity\Kosarica;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class KosaricaType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tezina')
            ->add('datum_isporuke')
            ->add('cijena')
            ->add('oprema')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Kosarica::class,
        ]);
    }
}
