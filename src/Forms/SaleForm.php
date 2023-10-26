<?php

namespace App\Forms;

use App\Rafinita\Entity\SaleEntity;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SaleForm extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SaleEntity::class,
        ]);
    }

    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('clientKey', TextType::class, ['required' => true])
            ->add('channelId', TextType::class, ['required' => false, 'attr' => ['maxlength' => 16]])
            ->add('orderId', TextType::class, ['required' => true, 'attr' => ['maxlength' => 255]])
            ->add('orderAmount', TextType::class, ['required' => true])
            ->add('orderCurrency', TextType::class, ['required' => true, 'attr' => ['maxlength' => 3, 'minlength' => 3]])
            ->add('orderDescription', TextareaType::class, ['required' => true, 'attr' => ['maxlength' => 1024]])
            ->add('cardNumber', TextType::class, ['required' => true])
            ->add('cardExpMonth', TextType::class, ['required' => true, 'attr' => ['maxlength' => 2, 'minlength' => 2]])
            ->add('cardExpYear', TextType::class, ['required' => true, 'attr' => ['maxlength' => 4, 'minlength' => 4]])
            ->add('cardCvv2', TextType::class, ['required' => true, 'attr' => ['maxlength' => 4, 'minlength' => 3]])
            ->add('payerFirstName', TextType::class, ['required' => true, 'attr' => ['maxlength' => 32]])
            ->add('payerLastName', TextType::class, ['required' => true, 'attr' => ['maxlength' => 32]])
            ->add('payerMiddleName', TextType::class, ['required' => false, 'attr' => ['maxlength' => 32]])
            ->add('payerBirthDate', TextType::class, ['required' => false, 'attr' => ['format' => 'Y-m-d']])
            ->add('payerAddress', TextType::class, ['required' => true, 'attr' => ['maxlength' => 255]])
            ->add('payerAddress2', TextType::class, ['required' => false, 'attr' => ['maxlength' => 255]])
            ->add('payerCountry', TextType::class, ['required' => true, 'attr' => ['maxlength' => 2, 'minlength' => 2]])
            ->add('payerState', TextType::class, ['required' => false, 'attr' => ['maxlength' => 32]])
            ->add('payerCity', TextType::class, ['required' => true, 'attr' => ['maxlength' => 32]])
            ->add('payerZip', TextType::class, ['required' => true, 'attr' => ['maxlength' => 10]])
            ->add('payerEmail', EmailType::class, ['required' => true])
            ->add('payerPhone', TextType::class, ['required' => true, 'attr' => ['maxlength' => 32]])
            ->add('termUrl3ds', TextType::class, ['required' => true, 'attr' => ['maxlength' => 1024]])
            ->add('recurringInit', ChoiceType::class, ['required' => false, 'choices' => ['Recurring Init' => ['Yes' => 'Y', 'No' => 'N',],],])
            ->add('auth', ChoiceType::class, ['required' => false, 'choices' => ['auth' => ['Yes' => 'Y', 'No' => 'N',],],])
            ->add('save', SubmitType::class);
    }
}