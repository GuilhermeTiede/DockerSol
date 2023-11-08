<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\DocumentosContrato;
use Illuminate\Http\Request;

class DocumentosContratosController extends Controller
{
    public function uploadDocumento(Request $request)
    {

        $documento = $request->file('documento');

        $destino = ("uploads");

        if ($documento->isValid()) {
            $nomeDocumento = $documento->getClientOriginalName();

            if ($documento->storeAs($destino, $nomeDocumento)) {
                $documentoscontrato = new DocumentosContrato();
                $documentoscontrato->contrato_id = $request->input('contrato_id'); // Suponha que o ID do contrato esteja no formulário
                $documentoscontrato->nomeDocumento = $nomeDocumento;
                $documentoscontrato->dataDocumento = now()->toDateString();
                $documentoscontrato->tipoDocumento = pathinfo($nomeDocumento, PATHINFO_EXTENSION);

                if ($documentoscontrato->save()) {
                    $documento->move($destino, $documento->getClientOriginalName());
                    return redirect()->back()->with('message', 'Documento anexado com sucesso!');
                } else {
                    return redirect()->back()->with('error', 'Falha ao salvar dados do documento!');
                }
            } else {
                return redirect()->back()->with('error', 'Falha ao anexar documento!');
            }
        } else {
            return redirect()->back()->with('error', 'Falha ao anexar documento!');
        }
    }
}
