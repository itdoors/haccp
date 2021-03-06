<?php

namespace ITDoors\HaccpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * PointStatisticsAdmin Class
 */
class PointStatisticsAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('point')
            ->add('characteristic')
            ->add('value')
            ->add('entryDate')
            ->add('createdAt');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('point')
            ->add('characteristic');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('point')
            ->add('characteristic')
            ->add('value')
            ->add('entryDate')
            ->add('createdAt');
    }
}
