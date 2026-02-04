<?php

namespace App\Form;

use App\Entity\zayEntity\Category;
use App\Entity\zayEntity\Product;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductCreateForm extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('product_name', TextType::class, ['required' => true])
            ->add('product_image', FileType::class, ['required' => true,])
            ->add('product_description', TextareaType::class, ['required' => true])
            ->add('quantity', TextType::class, ['required' => true])
            ->add('category', EntityType::class, [
                    'class' => Category::class,
                'choice_label' => 'categoryName',
                'placeholder' => 'Select',
                    'required' => true,
                ])
            ->add('price', TextType::class, ['required' => true])
            ->add('gst', TextType::class, ['required' => true]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }

}
