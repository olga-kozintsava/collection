<?php

declare(strict_types=1);

namespace App\Form\Type\Category;

use App\DTO\User\UserRegistrationData;
use App\Entity\Category;
use App\Form\Type\CustomField\CustomFieldType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;

class AddCategoryType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['attr' =>
                ['class' => 'form-control']])
            ->add('description', TextareaType::class, [
                'required' => false,
                'attr' => ['class' => 'form-control']])
            ->add('subject', ChoiceType::class, [
                'choices' => [
                    'Alcohol' => 'Alcohol',
                    'Books' => 'Books',
                    'Сoins' => 'Coins',
                ],
                'attr' => ['class' => 'form-control']])
            ->add('customField',  CollectionType::class, [
                'entry_type' =>CustomFieldType ::class,
                'required' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
                'allow_delete' => true,
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Add',
                'attr' => ['class' => 'btn btn-block btn-dark']
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}