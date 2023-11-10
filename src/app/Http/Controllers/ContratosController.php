<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Contrato;
use Illuminate\Http\Request;
use App\Models\DocumentosContrato;
use Carbon\Carbon;
class ContratosController extends Controller
{
    public readonly Contrato $contrato;
    public function __construct()
    {
        $this->contrato = new Contrato();
    }
    public function index()
    {
        $contratos = $this->contrato->all();
        return view('contratos.index', ['contratos' => $contratos]);
    }

    public function create(Contrato $contratos)
    {
        //
        $clientes = Cliente::all();
        return view('contratos.create',['contratos' => $contratos],[ 'clientes' => $clientes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        try {

            $request->validate([
                'nomeContrato' => 'required',
                'numeroContrato' => 'required',
                'dataInicio' => 'required',
                'dataFim' => 'required',
                'valorContrato' => 'required',
                'cliente_id' => 'required',
            ]);

            // Obtenha o valor formatado do campo 'valorOrdemServico'
            $valorFormatado = $request->input('valorContrato');

            // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
            $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

            // Converta o valor para um tipo numérico
            $valorNumerico = (float)$valorFormatado;

            $created = $this->contrato->create([
                'nomeContrato' => $request->nomeContrato,
                'numeroContrato' => $request->numeroContrato,
                'dataInicio' => $request->dataInicio,
                'dataFim' => $request->dataFim,
                'valorContrato' => $valorNumerico,
                'seguroGarantia' => $request->seguroGarantia,
                'responsabilidadeTecnica' => $request->responsabilidadeTecnica,
                'observacao' => $request->observacao,
                'cliente_id' => $request->cliente_id,
            ]);

            if ($created) {
                return redirect()->back()->with('message', 'Contrato cadastrado com sucesso!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Contrato $contrato)
    {
        $documentosContrato = DocumentosContrato::all();

        $clientes = Cliente::all();
//        return view('contratos.show', ['contrato' => $contrato],['clientes' => $clientes]);
        return view('contratos.show', [
            'contrato' => $contrato,
            'clientes' => $clientes,
            'documentosContrato' => $documentosContrato,
        ]);

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Contrato $contrato)
    {
        $clientes = Cliente::all();
        return view('contratos.edit', ['contrato' => $contrato],['clientes' => $clientes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Contrato $contrato)
    {
        $request->validate([
                'nomeContrato' => 'required',
                'numeroContrato' => 'required',
                'valorContrato' => 'required',
                'cliente_id' => 'required',
            ]);

        // Obtenha o valor formatado do campo 'valorContrato'
        $valorFormatado = $request->input('valorContrato');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        // Verifique se a data de início foi selecionada, caso contrário, mantenha o valor existente
        $dataInicio = $request->has('dataInicio')
            ? \Carbon\Carbon::parse($request->input('dataInicio'))->format('Y-m-d')
            : $contrato->dataInicio;

        // Verifique se a data de fim foi selecionada, caso contrário, mantenha o valor existente
        $dataFim = $request->has('dataFim')
            ? \Carbon\Carbon::parse($request->input('dataFim'))->format('Y-m-d')
            : $contrato->dataFim;

        $contrato->update([
            'nomeContrato'=> $request->nomeContrato,
            'numeroContrato' => $request->numeroContrato,
            'dataInicio' => $dataInicio,
            'dataFim' => $dataFim,
            'valorContrato' => $valorNumerico,
            'seguroGarantia' => $request->seguroGarantia,
            'responsabilidadeTecnica' => $request->responsabilidadeTecnica,
            'observacao' => $request->observacao,
            'cliente_id' => $request->cliente_id,
            'dataRenovacao' => $request->dataRenovacao,
            'renovado' => $request->renovado,
            $request->except('_token', '_method')
        ]);
        return redirect()->route('contratos.index')
            ->with('message', 'Contrato atualizado com sucesso!');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {

        $deleted = $this->contrato->find($id)->delete();
        return redirect()->route('contratos.index');
    }


}
