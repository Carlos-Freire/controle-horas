<?php

namespace Controle\Report\PDF;

use Mpdf\Mpdf;

class PDFReport
{
    protected $html;
    protected $date;

    public function __construct()
    {
        $file =  __DIR__ . DIRECTORY_SEPARATOR . 'pdf.html';
        $name = 'report_pdf_' . time() . '.pdf';
        $this->setHtml($file);
        $this->setDate(date("d/m/Y H:i:s"));
    }

    /**
     * @return false|string
     */
    public function getHtml()
    {
        return $this->html;
    }

    /**
     * @param false|string $file
     * @return PDFReport
     */
    protected function setHtml($file)
    {
        $this->html = file_get_contents($file);
        return $this;
    }

    /**
     * @return mixed
     */
    public function getDate()
    {
        return $this->date;
    }

    /**
     * @param mixed $date
     * @return PDFReport
     */
    protected function setDate($date)
    {
        $this->date = $date;
        return $this;
    }

    public function output($report)
    {
        $html = $this->getHtml();
        $date = $this->getDate();
        $html = str_replace("#data",$date,$html);

        $dev_html = $this->devHtml($report);
        $cliente_html = $this->clienteHtml($report);
        $area_html = $this->areaHtml($report);

        $html = str_replace("#relatorio_dev",$dev_html,$html);
        $html = str_replace("#relatorio_cliente",$cliente_html,$html);
        $html = str_replace("#relatorio_area",$area_html,$html);

        $mpdf = new Mpdf();
        $mpdf->WriteHTML($html);
        $mpdf->Output();
    }

    private function devHtml($report)
    {
        $html = '';
        if (isset($report['dev']) && count($report['dev']) > 0) {
            foreach($report['dev'] as $i) {
                $html .= "<tr><td>{$i['item']}</td><td>{$i['phrase']}</td></tr>";
            }
        }
        return $html;
    }

    private function clienteHtml($report)
    {
        $html = '';
        if (isset($report['cliente']) && count($report['cliente']) > 0) {
            foreach($report['cliente'] as $i) {
                $html .= "<tr><td>{$i['item']}</td><td>{$i['phrase']}</td></tr>";
            }
        }
        return $html;
    }

    private function areaHtml($report)
    {
        $html = '';
        if (isset($report['area']) && count($report['area']) > 0) {
            foreach($report['area'] as $i) {
                $html .= "<tr><td>{$i['item']}</td><td>{$i['phrase']}</td></tr>";
            }
        }
        return $html;
    }
}