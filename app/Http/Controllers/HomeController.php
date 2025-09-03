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
        $request->validate([
            'nome' => 'required|string',
            'pdf_principal' => 'required|file|mimes:pdf',
            'pdf_secundario' => 'required|file|mimes:pdf',
        ]);

        $nome = $request->input('nome');

        // Salvar uploads temporários
        $pdfPrincipalPath = $request->file('pdf_principal')->store('temp');
        $pdfSecundarioPath = $request->file('pdf_secundario')->store('temp');

        $pdfPrincipal = Storage::path($pdfPrincipalPath);
        $pdfSecundario = Storage::path($pdfSecundarioPath);
        $outputPath = Storage::path("temp/resultado-" . preg_replace('/\s+/', '_', $nome) . ".pdf");

        $ok = $pdfService->searchAndMerge($nome, $pdfPrincipal, $pdfSecundario, $outputPath);

        if (!$ok) {
            return back()->withErrors(['msg' => 'Nome não encontrado em um dos PDFs.']);
        }

        return response()->download($outputPath)->deleteFileAfterSend(true);
    }
}
