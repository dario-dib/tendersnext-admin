<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Supplier;
use App\Entity\SupplierOffer;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SupplierOfferType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('supplierSKU')
            ->add('productTitle')
            ->add('productDescription')
            ->add('leadTimeDays')
            ->add('PurchasePrice')
            ->add('PurchasePriceValidUntil')
            ->add('supplier', EntityType::class, [
                'class' => Supplier::class,
                'choice_label' => 'name',
            ])
            ->add('product', EntityType::class, [
                'class' => Product::class,
                'choice_label' => 'name',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => SupplierOffer::class,
        ]);
    }
}
