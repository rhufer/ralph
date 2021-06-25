<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use App\Entity\Type;
use Doctrine\DBAL\Types\StringType;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('description', TextareaType::class)
                ->add('name', TextType::class)
                ->add('price', PriceNumberType::class)
                ->add('slug', TextType::class)
                ->add('category', EntityType::class, ['class'=> Category::class,
                                                   'choice_label' => 'name',
])
             ->add('product_type', EntityType::class, ['class' => Type::class, 'choice_label' => 'name'])
             ->add('Sauvegarde', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
