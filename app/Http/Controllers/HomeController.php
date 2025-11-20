<?php

namespace App\Http\Controllers;

use App\Services\PdfService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    public function form()
    {
        return view('index');
    }

    public function gerar(Request $request, PdfService $pdfService)
    {
        set_time_limit(600); // 5 minutos
        ini_set('memory_limit', '-1'); // sem limite

        $request->validate([
            'nomes' => 'required|string',
            'pdf_principal' => 'required|file|mimes:pdf',
            'pdf_secundario' => 'required|file|mimes:pdf',
        ]);

        try {
            $nomes = preg_split('/\r\n|\r|\n/', trim($request->input('nomes')));

            $pdfPrincipalPath = $request->file('pdf_principal')->store('temp');
            $pdfSecundarioPath = $request->file('pdf_secundario')->store('temp');

            $pdfPrincipal = Storage::path($pdfPrincipalPath);
            $pdfSecundario = Storage::path($pdfSecundarioPath);
            $outputPath = Storage::path("temp/resultado-lista.pdf");

            $ok = $pdfService->searchAndMergeList($nomes, $pdfPrincipal, $pdfSecundario, $outputPath);

            if (!$ok) {
                return back()->withErrors(['msg' => 'Nenhum dos nomes foi encontrado nos PDFs.']);
            }

            return response()->download($outputPath)->deleteFileAfterSend(true);
        } catch (\Exception $e) {
            return back()->withErrors(['msg' => 'Erro ao processar: ' . $e->getMessage()]);
        }
    }
}
