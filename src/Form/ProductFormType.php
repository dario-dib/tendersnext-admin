<?php

namespace App\Form;

use App\Entity\PharmaActiveIngredient;
use App\Entity\Product;
use App\Entity\ProductTaxonomy;
use App\Entity\ProductType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Name')
            ->add('Description')
            ->add('productType', EntityType::class, [
                'class' => ProductType::class,
                'choice_label' => 'type_name',
            ])
            ->add('productTaxonomy', EntityType::class, [
                'class' => ProductTaxonomy::class,
                'choice_label' => 'name',
            ])
            ->add('pharmaActiveIngredient', EntityType::class, [
                'class' => PharmaActiveIngredient::class,
                'choice_label' => 'name',
            ])
            ->add('PharmaStrength')
            ->add('PharmaDosageForm');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
