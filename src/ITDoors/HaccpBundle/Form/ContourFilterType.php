<?php

namespace ITDoors\HaccpBundle\Form;
use ITDoors\HaccpBundle\Services\ContourService;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Contour filter form
 */
class ContourFilterType extends AbstractType
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
            ->add('contour', 'choice', array(
                'empty_value' => '',
                'choices' => $cs->getContourSlugChoices(),
                'attr' => array(
                    'class_outer' => 'col-md-5',
                    'class' => 'itdoors-select2 can-be-reseted',
                    'data-params' => json_encode(array(
                        'minimumInputLength' => 0,
                        'allowClear' => true,
                        //'multiple' => true,
                        'width' => '200px'
                    )),
                    'placeholder' => 'All Contours'
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
        return 'contourFilterType';
    }
}