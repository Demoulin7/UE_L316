<?php

namespace App\Form;

use App\Entity\Actualite;
use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class ActualiteType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('id_user')
            ->add('id_user')
            ->add('titre')
            ->add('contenu')
            ->add('auteur')
<<<<<<< HEAD
            //->add('date')

=======
            ->add('date')
            ->add('id_user')
>>>>>>> 5244ab2c88795cfa973e71194acc392c83d0de3c
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actualite::class,
        ]);
    }
}
