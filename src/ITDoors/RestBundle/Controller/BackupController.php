<?php

namespace ITDoors\RestBundle\Controller;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\Controller\Annotations as Rest;
use ITDoors\HaccpBundle\Services\PointApiV1Service;

use Nelmio\ApiDocBundle\Annotation\ApiDoc;
use Symfony\Component\HttpFoundation\Request;

/**
 * REST API Backup Controller class
 *
 * @author Pavel Pecheny <ppecheny@gmail.com>
 *
 */
class BackupController extends FOSRestController
{
    /**
     * @Rest\Get("/")
     *
     * @ApiDoc(
     *  description="Returns Gzip backup file",
     *  output="Gzip backup file"
     * )
     *
     * @return string
     */
    public function getAction()
    {

        $filePath = $this->container->getParameter('backup.json.file.path');
        $fileName = $this->container->getParameter('backup.json.file.name');

        header("Status: 200");
        header('Content-Type: gzip');
        header('Content-Disposition: attachment;filename=' . $fileName);

        // Read file content
        readfile($filePath);
    }
}