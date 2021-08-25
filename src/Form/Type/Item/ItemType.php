<?php

declare(strict_types=1);

namespace App\Form\Type\Item;

use App\Entity\CustomField;
use App\Form\Type\Category\AddCategoryType;
use App\Entity\Item;
use App\Form\Type\Tag\TagType;
use App\Repository\CustomFieldRepository;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormEvent;
use Symfony\Component\Form\FormEvents;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ItemType extends AbstractType
{

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     *
     */
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, ['attr' =>
                ['class' => 'form-control']])
            ->add('tag', CollectionType::class, [
                'entry_type' => TagType::class,
                'required' => false,
                'entry_options' => ['label' => false],
                'allow_add' => true,
                'by_reference' => false,
            ])
            ->add('add', SubmitType::class, [
                'label' => 'Add',
                'attr' => ['class' => 'btn btn-block btn-dark']
            ]);
        $builder->addEventListener(FormEvents::PRE_SET_DATA, function (FormEvent $event) {
            $fields = $event->getForm()->getConfig()->getOptions()['fields'];
            $form = $event->getForm();
            if (!is_null($fields)){
                foreach ($fields as $value) {
                    $form->add($value->getTitle(), TextType::class, ['mapped' => false]);
                }
            }


        });
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setRequired('fields');
        $resolver->setDefaults([
            'data_class' => Item::class,
        ]);

    }
}