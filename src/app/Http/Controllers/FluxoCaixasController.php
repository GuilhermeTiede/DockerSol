<?php

namespace App\Http\Controllers;

use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\FontePagadora;
use App\Models\OrdemServico;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

class FluxoCaixasController extends Controller
{
    public readonly FluxoCaixa $fluxoCaixa;

    public function __construct()
    {
        $this->fluxoCaixa = new FluxoCaixa();
    }

    public function index(Request $request)
    {
        $contratos = Contrato::all();

        $filtroContrato = $request->input('contrato');
        $filtroOrdemServico = $request->input('ordem_servico');
        $dataInicio = $request->input('data_inicio');
        $dataFim = $request->input('data_fim');

        $fluxoCaixas = FluxoCaixa::query();

        if (!empty($filtroContrato)) {
            $fluxoCaixas->whereHas('ordemServico.contrato', function ($query) use ($filtroContrato) {
                $query->where('id', $filtroContrato);
            });
        }

        if (!empty($filtroOrdemServico)) {
            $fluxoCaixas->where('id_ordemServico', $filtroOrdemServico);
        }

        if (!empty($dataInicio) && !empty($dataFim)) {
            $fluxoCaixas->whereBetween('data', [$dataInicio, $dataFim]);
        }

        // Obtém as Ordens de Serviço para o seletor de filtro
        $ordemServicos = OrdemServico::all();

        $fluxoCaixas = $fluxoCaixas->get();



            return view('fluxocaixas.index', compact('fluxoCaixas', 'contratos', 'ordemServicos'));

    }

    public function create()
    {
        $ordemServicos = OrdemServico::all();
        $fontePagadoras = FontePagadora::all();
        $contratos = Contrato::all();
        return view('fluxocaixas.create' , [
            'ordemServicos' => $ordemServicos,
            'fontePagadoras' => $fontePagadoras,
            'contratos' => $contratos,
        ]);
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário
        $request->validate([
            'id_ordemServico'=>'required',
            'id_fontePagadora' => 'required',
            'tipo' => 'required',
            'valor' => 'required',
            'data',
            'observacao'
        ]);

        $valorFormatado = $request->input('valor');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        // Se a validação passar, crie o fluxo de caixa
        $created = $this->fluxoCaixa->create([
            'id_ordemServico' => $request->id_ordemServico,
            'id_fontePagadora' => $request->id_fontePagadora,
            'tipo' => $request->tipo,
            'valor' => $valorNumerico,
            'observacao' => $request->observacao,
            'data' => $request->data,
        ]);

        if ($created) {
            return redirect()->back()->with('message', 'Fluxo de caixa cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao cadastrar fluxo de caixa!');
        }
    }

    public function show(FluxoCaixa $fluxoCaixa)
    {
        $ordemServico = OrdemServico::all();
        $fontePagadora = FontePagadora::all();
        return view('fluxocaixas.show',
            [
                'fluxoCaixa' => $fluxoCaixa,
                'ordemServico' => $ordemServico,
                'fontePagadora' => $fontePagadora,
            ]);
    }

    public function edit(FluxoCaixa $fluxoCaixa)
    {
        $ordemServicos = OrdemServico::all();
        $fontePagadoras = FontePagadora::all();

        return view('fluxocaixas.edit',
            [
                'fluxoCaixa' => $fluxoCaixa,
                'ordemServicos' => $ordemServicos,
                'fontePagadoras' => $fontePagadoras,


            ]);
    }

    public function update(Request $request, FluxoCaixa $fluxoCaixa)
    {

        $request->validate([
            'id_ordemServico'=>'required',
            'id_fontePagadora' => 'required',
            'tipo' => 'required',
            'valor' => 'required',
            'data',
            'observacao'
        ]);

        // Obtenha o valor formatado do campo 'valorFluxoCaixa'
        $valorFormatado = $request->input('valor');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;


        $fluxoCaixa->update([
            'id_ordemServico' => $request->id_ordemServico,
            'id_fontePagadora' => $request->id_fontePagadora,
            'tipo' => $request->tipo,
            'valor' => $valorNumerico,
            'observacao' => $request->observacao,
            'data' => $request->data,
        ]);

        if ($fluxoCaixa) {
            return redirect()->back()->with('message', 'Fluxo de caixa atualizado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao atualizar fluxo de caixa!');
        }

    }

    public function destroy(string $id)
    {
        $deleted = $this->fluxoCaixa->find($id)->delete();

        if ($deleted) {
            return redirect()->back()->with('message', 'Fluxo de caixa excluído com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao excluir fluxo de caixa!');
        }
    }

    public function getOrdemServicoPorContrato(Request $request)
    {
        // Receba o ID do contrato selecionado através de uma solicitação AJAX
        $contratoId = $request->input('contrato_id');

        // Consulta para obter as Ordens de Serviço correspondentes ao contrato selecionado
        $ordemServicos = DB::table('ordemservicos')
            ->where('contrato_id', $contratoId)
            ->get();

        // Retorne as Ordens de Serviço como resposta em formato JSON
        return response()->json($ordemServicos);
    }
}
