<?php

namespace ITDoors\HaccpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * PlanAdmin Class
 */
class PlanAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('CompanyObject', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\CompanyObject'
            ))
            ->add('parent')
            ->add('parentLatitudeTopLeft')
            ->add('parentLongitudeTopLeft')
            ->add('parentLatitudeBottomRight')
            ->add('parentLongitudeBottomRight')
            ->add('type')
            ->add('maxZoom');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('parent');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('parent')
            ->add('parentLatitudeTopLeft')
            ->add('parentLongitudeTopLeft')
            ->add('parentLatitudeBottomRight')
            ->add('parentLongitudeBottomRight')
            ->add('type')
            ->add('maxZoom');
    }
}
