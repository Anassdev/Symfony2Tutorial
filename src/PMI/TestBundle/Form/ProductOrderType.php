<?php

namespace PMI\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;

class ProductOrderType extends AbstractType
{
    public function buildForm(FormBuilder $builder, array $options)
    {
        $builder
            ->add('product')
            ->add('order')
        ;
    }

    public function getName()
    {
        return 'pmi_testbundle_productordertype';
    }
}
