<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class OrdemServicoController extends Controller
{

    public readonly OrdemServico $ordemServico;

    public function __construct()
    {
        $this->ordemServico = new OrdemServico();
    }
    public function index()
    {
        $ordensServico = OrdemServico::all();
        return view('ordensservicos.index', compact('ordensServico'));
    }

    public function create()
    {
        $contratos = Contrato::all();

        return view('ordensservicos.create', ['contratos' => $contratos]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'contrato_id' => 'required',
            'valorOrdemServico' => 'required',
            'dataOrdemServico' => 'required',
            'numeroOrdemServico' => 'required',
        ]);

        // Obtenha o valor formatado do campo 'valorOrdemServico'
        $valorFormatado = $request->input('valorOrdemServico');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        $created = $this->ordemServico->create([
            'contrato_id' => $request->contrato_id,
            'valorOrdemServico' => $valorNumerico,
            'dataOrdemServico' => $request->dataOrdemServico,
            'numeroOrdemServico' => $request->numeroOrdemServico,
        ]);

        if($created) {
            return redirect()->back()->with('message', 'Ordem de serviço cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao cadastrar ordem de serviço!');
        }
    }

    public function show(OrdemServico $ordemServico)
    {
        $contratos = Contrato::all();
        return view('ordensservicos.show', compact('ordemServico'), ['contratos' => $contratos]);
    }

    public function edit(OrdemServico $ordemServico)
    {
        $contratos = Contrato::all();
        return view('ordensservicos.edit', compact('ordemServico'), ['contratos' => $contratos]);
    }

    public function update(Request $request, OrdemServico $ordemServico)
    {
        $request->validate([
            'contrato_id' => 'required',
            'valorOrdemServico' => 'required',
            'dataOrdemServico' => 'required',
            'numeroOrdemServico' => 'required',
        ]);

        // Obtenha o valor formatado do campo 'valorOrdemServico'
        $valorFormatado = $request->input('valorOrdemServico');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        $ordemServico->update([
            'contrato_id' => $request->contrato_id,
            'valorOrdemServico' => $valorNumerico,
            'dataOrdemServico' => $request->dataOrdemServico,
            'numeroOrdemServico' => $request->numeroOrdemServico,
        ]);

        return redirect()->route('ordensservicos.index')
            ->with('success', 'Ordem de serviço atualizada com sucesso.');
    }

    public function destroy(OrdemServico $ordemServico)
    {
        $ordemServico->delete();

        return redirect()->route('ordensservicos.index')
            ->with('success', 'Ordem de serviço excluída com sucesso.');
    }
}
