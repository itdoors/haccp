<?php

namespace ITDoors\HaccpBundle\Controller;
use ITDoors\CommonBundle\Controller\BaseFilterController;
use ITDoors\HaccpBundle\Services\ContourService;
use Symfony\Component\HttpFoundation\Response;

/**
 * Contour Controller
 */
class ContourController extends BaseFilterController
{
    /**
     * Returns all contour choices
     */
    public function choicesAjaxAction()
    {
        /** @var ContourService $cs */
        $cs = $this->container->get('contour.service');

        $result = $cs->getContourChoices();

        return new Response(json_encode($result));
    }

    /**
     * Returns contour choices by ids
     *
     * @return string
     */
    public function choicesByIdsAjaxAction()
    {
        $ids = explode(',', $this->get('request')->query->get('id'));

        /** @var ContourService $cs */
        $cs = $this->container->get('contour.service');

        $result = $cs->getContourChoices($ids);

        return new Response(json_encode($result));
    }
}