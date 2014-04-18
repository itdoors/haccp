<?php

namespace ITDoors\HaccpBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Form\FormMapper;

/**
 * PointAdmin Class
 */
class PointAdmin extends Admin
{
    // Fields to be shown on create/edit forms
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('name')
            ->add('contour', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\Contour'
            ))
            ->add('plan', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\Plan'
            ))
            ->add('group', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\PointGroup'
            ))
            ->add('status', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\PointStatus'
            ))
            ->add('installationDate')
            ->add('imageLatitude')
            ->add('imageLongitude')
            ->add('mapLatitude')
            ->add('mapLongitude');
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('plan')
            ->add('contour')
            ->add('group')
            ->add('status');
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('contour')
            ->add('plan')
            ->add('group')
            ->add('status')
            ->add('installationDate')
            ->add('imageLatitude')
            ->add('imageLongitude')
            ->add('mapLatitude')
            ->add('mapLongitude');
    }
}
