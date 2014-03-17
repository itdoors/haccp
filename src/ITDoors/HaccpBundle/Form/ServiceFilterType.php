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
class ServiceFilterType extends AbstractType
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
        /** @var ContourService $cs */
        $cs = $this->container->get('contour.service');

        $builder
            ->add('serviceId', 'choice', array(
                'empty_value' => '',
                'choices' => $cs->getServiceChoices(),
                'attr' => array(
                    'class_outer' => 'col-md-5',
                    'class' => 'itdoors-select2 can-be-reseted',
                    'data-params' => json_encode(array(
                        'minimumInputLength' => 0,
                        'allowClear' => true,
                        'width' => '200px'
                    )),
                    'placeholder' => 'All Services'
                )
            ))
            ->add('daterangecustom', 'daterangecustom', array(
                'attr' => array(
                    'class_outer' => 'col-md-7'
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
        return 'serviceFilterType';
    }
}