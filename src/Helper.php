<?php

/***
 * Helper function render a report
 *
 * @param $path
 * @param string $type
 * @param string $name
 * @param array $params
 * @return mixed
 * @throws Exception
 */
function render_report($path, $type = "pdf", $name = "report", $params = []) {
    try {

        $manager = app(\Julfiker\Jasper\Manager\JasperReport::class)
                    ->setServerUrl(config('jasper.server_url'))
                    ->setUsername(config('jasper.username'))
                    ->setPassword(config('jasper.password'))
                    ->make();

        $reportContent = $manager
            ->setPath($path)
            ->setType($type)
            ->setParams($params)
            ->generate();

        $fileName = $name ?? 'report' . "." . $type;
        $controller = app(\Julfiker\Jasper\JasperReportPublisherController::class);
        $controller->fileName = $fileName;

        if ($type == 'pdf')
            return $controller->renderPdf($reportContent);

        if ($type == 'xlsx')
            return $controller->downloadExcel($reportContent);

        return $reportContent;
    }
    catch (Exception $e) {
        throw  $e;
    }
}
