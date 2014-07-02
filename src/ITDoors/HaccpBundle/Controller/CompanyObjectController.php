<?php

namespace ITDoors\HaccpBundle\Controller;
use ITDoors\AjaxBundle\Controller\BaseFilterController;
use ITDoors\HaccpBundle\Entity\CompanyObject;
use ITDoors\HaccpBundle\Entity\CompanyObjectRepository;
use ITDoors\HaccpBundle\Services\CompanyObjectService;
use ITDoors\HaccpBundle\Services\ContourService;
use Symfony\Component\HttpFoundation\Response;

/**
 * CompanyObject Controller
 */
class CompanyObjectController extends BaseFilterController
{
    /**
     * Returns infestation
     *
     * @return string
     */
    public function infestationAction()
    {
        return $this->render('ITDoorsHaccpBundle:CompanyObject:infestation.html.twig');
    }

    /**
     * Returns infestation content
     *
     * @return string
     */
    public function infestationContentAction()
    {
        /** @var CompanyObjectRepository $cor */
        $cor = $this->get('company.object.repository');

        /** @var CompanyObjectService $cos */
        $cos = $this->get('company.object.service');

        /** @var CompanyObject[] $objects */
        $objects = $cor->findAll();

        $infestations = array();

        foreach ($objects as $object) {
            $infestations[$object->getId()][] = array(
                'data' => $cos->getInfestation($object, new \DateTime()),
                'label' => $object->getName()
            );
        }

        return $this->render('ITDoorsHaccpBundle:CompanyObject:infestationContent.html.twig', array(
            'infestations' => $infestations,
            'objects' => $objects
        ));
    }
}
