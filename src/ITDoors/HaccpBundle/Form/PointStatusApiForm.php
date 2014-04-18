<?php

namespace ITDoors\HaccpBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * PointStatusApiForm Class
 */
class PointStatusApiForm extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array                $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('statusId', 'hidden');
    }

    /**
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'ITDoorsHaccpBundle',
            'data_class' => 'ITDoors\HaccpBundle\Entity\PointStatus',
        ));
    }

    /**
    * {@inheritDoc}
    */
    public function getName()
    {
        return 'pointStatusApiForm';
    }
}
