<?php

namespace App\Http\Controllers;
use App\Models\ContaAPagar;
use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\FontePagadora;
use App\Models\OrdemServico;
use Illuminate\Http\Request;

class ContasAPagarController extends Controller
{
    public readonly ContaAPagar $conta;

    public function __construct()
    {
        $this->conta = new ContaAPagar();
    }

    public function index()
    {
        $contas = $this->conta->all();
        return view('contasapagar.index', ['contas' => $contas]);
    }

    public function create()
    {

        $ordemServicos =  OrdemServico::all();
        $fontePagadoras = FontePagadora::all();
        $contratos = Contrato::all();
        return view('contasapagar.create', [
            'ordemServicos' => $ordemServicos,
            'fontePagadoras' => $fontePagadoras,
            'contratos' => $contratos]);
    }

    public function store(Request $request)
    {
        // Valide os dados do formulário
        $request->validate([
            'id_ordemServico' => 'required',
            'id_fontePagadora' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'dataVencimento' => 'required',
            'status' => 'required',
        ]);
        //Sempre Será contas a Pagar!
        $tipo = 'pagar';
        $valorFormatado = $request->input('valor');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        // Se a validação passar, crie a conta
        $created = $this->conta->create([
            'tipo' => $tipo,
            'descricao' => $request->descricao,
            'valor' => $valorNumerico,
            'dataVencimento' => $request->dataVencimento,
            'dataPagamento' => $request->dataPagamento,
            'status' => $request->status,
            'id_ordemServico' => $request->id_ordemServico,
            'id_fontePagadora' => $request->id_fontePagadora,
        ]);

        if ($created) {
            return redirect()->back()->with('message', 'Conta cadastrada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao cadastrar conta!');
        }
    }


    public function show(ContaAPagar $conta)
    {
        return view('contasapagar.show', ['conta' => $conta]);
    }

    public function edit(ContaAPagar $conta)
    {
        $ordemServicos = OrdemServico::all();
        $fontePagadoras = FontePagadora::all();
        return view('contasapagar.edit', [

            'fontePagadoras' => $fontePagadoras,
            'ordemServicos' => $ordemServicos,
            'conta' => $conta

        ]);
    }

    public function update(Request $request, ContaAPagar $conta)
    {

    // Valide os dados do formulário
        $request->validate([
            'id_ordemServico' => 'required',
            'id_fontePagadora' => 'required',
            'descricao' => 'required',
            'valor' => 'required',
            'dataVencimento' => 'required',
            'status' => 'required',
        ]);
        //Sempre Será contas a Pagar!
        $tipo = 'pagar';
        $valorFormatado = $request->input('valor');

        // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
        $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

        // Converta o valor para um tipo numérico
        $valorNumerico = (float) $valorFormatado;

        // Se a validação passar, crie a conta
            $conta->update([
            'tipo' => $tipo,
            'descricao' => $request->descricao,
            'valor' => $valorNumerico,
            'dataVencimento' => $request->dataVencimento,
            'dataPagamento' => $request->dataPagamento,
            'status' => $request->status,
            'id_ordemServico' => $request->id_ordemServico,
            'id_fontePagadora' => $request->id_fontePagadora,
        ]);

        if ($conta) {
            return redirect()->back()->with('message', 'Conta atualizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao atualizar conta!');
        }

    }

    public function destroy(ContaAPagar $conta)
    {
        $deleted = $conta->delete();

        if ($deleted) {
            return redirect()->route('contasapagar.index')->with('message', 'Conta a pagar excluída com sucesso!');
        } else {
            return redirect()->route('contasapagar.index')->with('error', 'Falha ao excluir conta a pagar!');
        }
    }

    public function mudarStatus(Request $request, $id)
    {

        // Encontre a conta pelo ID
        $conta = $this->conta->find($id);




        if (!$conta) {
            return redirect()->back()->with('error', 'Conta não encontrada!');
        }

        // Verifique se o novo status é "pago"
        if ($request->status === 'pago') {
            // Crie um novo registro no Fluxo de Caixa
            $fluxoCaixa = new FluxoCaixa();


            $fluxoCaixa->id_ordemServico = $conta->id_ordemServico;
            $fluxoCaixa->id_fontePagadora = $conta->id_fontePagadora;
            $fluxoCaixa->tipo = 'saida';
            $fluxoCaixa->valor = $conta->valor; // Valor negativo, pois é uma despesa
            $fluxoCaixa->observacao = 'Conta paga: ' . $conta->descricao ;// Adapte conforme sua estrutura de dados
            $fluxoCaixa->data = $conta->dataPagamento;




            if ($fluxoCaixa->save()) {
                // Delete a conta
                $conta->delete();
                return redirect()->back()->with('message', 'Conta marcada como paga e transferida para o Fluxo de Caixa com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Falha ao transferir conta para o Fluxo de Caixa!');
            }
        }

        return redirect()->back()->with('message', 'Status da conta atualizado com sucesso!');
    }


}
