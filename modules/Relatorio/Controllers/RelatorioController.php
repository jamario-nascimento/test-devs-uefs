<?php

namespace Modules\Relatorio\Controllers;

use App\Http\Controllers\Controller;
use Barryvdh\DomPDF\PDF;
use Modules\Relatorio\Services\Interfaces\RelatorioServiceInterface;
use Exception;

/**
 * @OA\Info(title="Livros", version="0.1")
 */
class RelatorioController extends Controller
{
    protected $service;

    public function __construct(RelatorioServiceInterface $service)
    {
        $this->service = $service;
    }

    /**
     * Listagem dos dados para WEB
     */
    public function index()
    {
        try {
            $relatorios = $this->service->list();
            return view('relatorio.listar', compact('relatorios'));
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a listagem Web'], 500);
        }
    }

    /**
     * Exportar dos dados para WEB
     */
    public function exportar()
    {
        try {
            $relatorios = $this->service->list();
            //return view('relatorio.exportar', compact('relatorios'));
            $pdf = app('dompdf.wrapper');
            $pdf->loadView('relatorio.exportar', compact('relatorios'));
            return $pdf->download('relatorio.pdf');
        } catch (Exception $ex) {
            report($ex);
            return response()->json(['message' => 'Falha ao efetuar a exportação do relatório Web'], 500);
        }
    }

}
