<?php
namespace ITDoors\HaccpBundle\Command;

use ITDoors\HaccpBundle\Services\CompanyObjectService;
use ITDoors\HaccpBundle\Services\CompanyService;
use ITDoors\HaccpBundle\Services\ContourService;
use ITDoors\HaccpBundle\Services\PlanService;
use ITDoors\HaccpBundle\Services\PointGroupCharacteristicService;
use ITDoors\HaccpBundle\Services\PointGroupService;
use ITDoors\HaccpBundle\Services\PointService;
use ITDoors\HaccpBundle\Services\PointStatisticsService;
use ITDoors\HaccpBundle\Services\PointStatusService;
use ITDoors\HaccpBundle\Services\ServiceService;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;


/**
 * BackupDbToJsonCommand
 */
class BackupDbToJsonCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('itdoors:haccp:backup-db-to-json')
            ->setDescription('Does db backup in json format for mobile sync');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("Start");

        $content = array();

        // Company
        /** @var CompanyService $companyService */
        //$companyService = $this->getContainer()->get('company.service');
        //$content['company'] = $companyService->getBackupData();

        // Company object
        /** @var CompanyObjectService $companyObjectService */
        //$companyObjectService = $this->getContainer()->get('company.object.service');
        //$content['company_object'] = $companyObjectService->getBackupData();

        // Contour
        /** @var ContourService $contourService */
        //$contourService = $this->getContainer()->get('contour.service');
        //$content['contour'] = $contourService->getBackupData();

        // Plan
        /** @var PlanService $planService */
        //$planService = $this->getContainer()->get('plan.service');
        //$content['plan'] = $planService->getBackupData();

        // Point
        /** @var PointService $pointService */
        //$pointService = $this->getContainer()->get('point.service');
        //$content['point'] = $pointService->getBackupData();

        // Point group
        /** @var PointGroupService $pointGroupService */
        //$pointGroupService = $this->getContainer()->get('point.group.service');
        //$content['point_group'] = $pointGroupService->getBackupData();

        // Point group characteristic
        /** @var PointGroupCharacteristicService $pointGroupCharacteristicService */
        //$pointGroupCharacteristicService = $this->getContainer()->get('point.characteristic.service');
        //$content['point_group_characteristic'] = $pointGroupCharacteristicService->getBackupData();

        // Point statistics
        /** @var PointStatisticsService $pointStatisticsService */
        //$pointStatisticsService = $this->getContainer()->get('point.statistics.service');
        //$content['point_statistics'] = $pointStatisticsService->getBackupData();

        // Point status
        /** @var PointStatusService $pointStatusService */
        $pointStatusService = $this->getContainer()->get('point.status.service');
        $content['point_status'] = $pointStatusService->getBackupData();

        // Service
        /** @var ServiceService $serviceService */
        //$serviceService = $this->getContainer()->get('service.service');
        //$content['service'] = $serviceService->getBackupData();

        $this->writeToFile($content);

        $output->writeln("End");
    }

    /**
     * Writes to file
     */
    public function writeToFile($content)
    {
        $backFile = $this->getContainer()->getParameter('backup.json.file.path');
        $gzdata = gzencode(json_encode($content), 9);
        $fp = fopen($backFile, "w");
        fwrite($fp, $gzdata);
        fclose($fp);
    }
}