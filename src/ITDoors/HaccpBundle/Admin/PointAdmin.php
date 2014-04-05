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
            ->add('Contour', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\Contour'
            ))
            ->add('Plan', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\Plan'
            ))
            ->add('Group', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\PointGroup'
            ))
            ->add('Status', 'entity', array(
                'class' => 'ITDoors\HaccpBundle\Entity\PointStatus'
            ))
            ->add('installationDate')
            ->add('imageLatitude')
            ->add('imageLongitude')
            ->add('mapLatitude')
            ->add('mapLongitude')
        ;
    }

    // Fields to be shown on filter forms
    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('name')
            ->add('Plan')
            ->add('Contour')
            ->add('Group')
            ->add('Status')
        ;
    }

    // Fields to be shown on lists
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('id')
            ->add('name')
            ->add('Contour')
            ->add('Plan')
            ->add('Group')
            ->add('Status')
            ->add('installationDate')
            ->add('imageLatitude')
            ->add('imageLongitude')
            ->add('mapLatitude')
            ->add('mapLongitude')
        ;
    }
}