<?php

namespace Julfiker\Jasper;

use Julfiker\Jasper\Manager\JasperReport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class JasperReportPublisherController extends Controller
{
    /** @var JasperReport  */
    private $jasperReport;

    public $fileName;

    /**
     * OraclePublisherController constructor.
     * @param JasperReport $jasperReport
     */
    public function __construct(JasperReport $jasperReport)
    {
        $this->jasperReport = $jasperReport;

    }

    /**
     * Render pdf
     *
     * @param Request $request
     * @return mixed
     */
    public function render(Request $request, $title = "report") {
        /** configuring with jasper credentials */
        $this->jasperReport->setServerUrl(config('jasper.server_url'))
            ->setUsername(config('jasper.username'))
            ->setPassword(config('jasper.password'))
            ->make();

        $path = $request->get('path');
        $type= $request->get('type');

        $this->fileName = $request->get('name')?$request->get('name').".".$type:'report'.".".$type;

        $params = $request->all();
        unset($params['type']);
        unset($params['path']);
        unset($params['name']);
        try {
            $reportContent = $this->jasperReport
                ->setPath($path)
                ->setType($type)
                ->setParams($params)
                ->setRequestTimeout(config('request_time_out'))
                ->generate();

            if ($type == 'pdf')
                return $this->renderPdf($reportContent);

            if ($type == 'xlsx')
                return $this->downloadExcel($reportContent);

            return $reportContent;

            //Todo: do staff for other type of file
            exit;
        }
        catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Render pdf
     *
     * @param $reportContent
     * @return \Illuminate\Http\Response
     */
    public function renderPdf($reportContent) {
        $filename = $this->fileName?:'file'.".pdf";

        return response()->make($reportContent, 200, [
            'Content-Type' => 'application/pdf',
            'Content-Disposition' => 'inline; filename="'.$filename.'"'
        ]);
    }

    public function downloadExcel($reportContent) {
        $filename = $this->fileName?:'file'.".xlsx";
        return response()->make($reportContent, 200, [
            'Content-Type' => 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet',
            'Content-Disposition' => 'attachment; filename="'.$filename.'"'
        ]);
    }
}
