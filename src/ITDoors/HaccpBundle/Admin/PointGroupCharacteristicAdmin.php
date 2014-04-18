<?php

namespace ITDoors\HaccpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * PointGroupCharacteristicAdmin Class
 */
class PointGroupCharacteristicAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('group')
            ->add('description')
            ->add('unit')
            ->add('dataType')
            ->add('inputType')
            ->add('allowValueMax')
            ->add('allowValueMin')
            ->add('criticalValueTop')
            ->add('criticalValueBottom');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('group');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('group')
            ->add('description')
            ->add('unit')
            ->add('dataType')
            ->add('inputType')
            ->add('allowValueMax')
            ->add('allowValueMin')
            ->add('criticalValueTop')
            ->add('criticalValueBottom');
    }
}
