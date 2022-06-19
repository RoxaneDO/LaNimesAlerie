<?php

namespace App\Form;

use App\Entity\Orders;
use App\Entity\Payment;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class OrderPaymentType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('payment', EntityType::class, [
            'class' => Payment::class,
            'choice_label' => 'paiement_mode',
            'expanded' => true,
            'multiple' => false
        ])
    ;
}

public function configureOptions(OptionsResolver $resolver)
{
    $resolver->setDefaults([
        'data_class' => Orders::class,
    ]);
}
}
