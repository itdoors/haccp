<?php

namespace ITDoors\HaccpBundle\Form;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * PointStatisticsApiForm Class
 */
class PointStatisticsApiForm extends AbstractType
{
    /**
    * @param FormBuilderInterface $builder
    * @param array $options
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('characteristic', 'hidden_entity', array(
                'entity' => 'ITDoorsHaccpBundle:PointGroupCharacteristic'
            ))
            ->add('createdAt', 'datetime', array(
                'widget' => 'single_text',
                'format' => 'U'
            ))
            ->add('entryDate', 'datetime')
            ->add('value')
        ;
    }

    /**
    * @param OptionsResolverInterface $resolver
    */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'ITDoorsHaccpBundle',
            'data_class' => 'ITDoors\HaccpBundle\Entity\PointStatistics',
        ));
    }

    /**
    * {@inheritDoc}
    */
    public function getName()
    {
        return 'pointStatisticsApiForm';
    }
}