<?php

namespace PMI\TestBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilder;


class OrderType extends AbstractType
{

    public function buildForm(FormBuilder $builder , array $options)
    {

        $builder
                ->add('name')
                ->add('Product' , 'entity' , array(
                    'class'    => 'PMITestBundle:Product' ,
                    'property' => 'name' ,
                    'expanded' => true ,
                    'multiple' => true , ))
        ;
    }

    public function getName()
    {
        return 'pmi_testbundle_ordertype';
    }

    public function getDefaultOptions(array $options)
    {
        return array(
            'data_class' => 'PMI\TestBundle\Entity\Order' ,
            'em'         => '' ,
        );
    }


}
