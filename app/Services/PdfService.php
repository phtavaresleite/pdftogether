<?php

namespace App\Services;

use Smalot\PdfParser\Parser;
use setasign\Fpdi\Fpdi;

class PdfService
{
    protected $parser;

    public function __construct()
    {
        $this->parser = new Parser();
    }

    public function searchAndMerge(string $nome, string $pdfPrincipal, string $pdfSecundario, string $outputPath)
    {
        $pdfPrincipalObj = $this->parser->parseFile($pdfPrincipal);
        $pdfSecundarioObj = $this->parser->parseFile($pdfSecundario);

        $paginasPrincipal = $pdfPrincipalObj->getPages();
        $paginasSecundario = $pdfSecundarioObj->getPages();

        $paginaPrincipal = $this->findPageWithName($paginasPrincipal, $nome);
        $paginaSecundario = $this->findPageWithName($paginasSecundario, $nome);

        if (!$paginaPrincipal || !$paginaSecundario) {
            return false;
        }

        $pdf = new FPDI();

        // Página do principal
        $pdf->setSourceFile($pdfPrincipal);
        $tpl = $pdf->importPage($paginaPrincipal);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);

        // Página do secundário
        $pdf->setSourceFile($pdfSecundario);
        $tpl = $pdf->importPage($paginaSecundario);
        $pdf->AddPage();
        $pdf->useTemplate($tpl);

        $pdf->Output('F', $outputPath);

        return true;
    }

    private function findPageWithName($paginas, $nome)
    {
        foreach ($paginas as $index => $pagina) {
            if (stripos($pagina->getText(), $nome) !== false) {
                return $index + 1; // FPDI começa em 1
            }
        }
        return null;
    }
}
