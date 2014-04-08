<?php

namespace ITDoors\HaccpBundle\Form;
use ITDoors\HaccpBundle\Services\ContourService;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Filter form type
 */
class PointStatisticsDateRangeType extends AbstractType
{
    /**
     * @var Container $container
     */
    protected $container;

    /**
     * __construct
     *
     * @param Container $container
     */
    public function __construct(Container $container)
    {
        $this->container = $container;
    }

    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('daterangecustom', 'daterangecustom', array(
                'attr' => array(
                    'class_outer' => 'col-md-3'
                )
            ));
    }

    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'translation_domain' => 'ITDoorsHaccpBundle'
        ));
    }

    /**
     * @{@inheritDoc}
     */
    public function getName()
    {
        return 'pointStatisticsDateRangeType';
    }
}