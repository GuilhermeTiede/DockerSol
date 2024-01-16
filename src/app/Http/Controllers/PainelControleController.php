<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\ContaAPagar;
use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\NotaFiscal;
use App\Models\OrdemServico;
use App\Models\PainelControle;
use App\Models\StatusNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Financeiro;

class PainelControleController extends Controller
{
    public readonly PainelControle $painel;

    public function __construct()
    {
        $this->painel = new PainelControle();
    }


    public function index()
    {
        // Recupere todos os clientes
        $clientes = Cliente::all();

        // Inicialize um array para armazenar os dados do Painel de Controle
        $dadosPainel = [];

        // Itere sobre cada cliente para calcular os dados
        foreach ($clientes as $cliente) {

            // Recupere todos os contratos vinculados a este cliente
            $contratos = Contrato::where('cliente_id', $cliente->id)->get();




            // Inicialize as variáveis de despesas e recebimento para cada cliente

            foreach ($contratos as $contrato) {
                // Verifique se já existe um registro na tabela para este cliente
                $painelControle = PainelControle::firstOrNew(['contrato' => $contrato->nomeContrato]);

                // Se o valor de "A Receber Previsão" não estiver definido, use o valor padrão
                if ($painelControle->a_receber_previsao === null) {
                    $aReceberPrevisao = 1; // Substitua pelo valor real
                } else {
                    $aReceberPrevisao = $painelControle->a_receber_previsao;
                }

                $despesasCliente = 0;
                $recebimentoCliente = 0;
                // Recupere as ordens de serviço vinculadas a este contrato
                $ordensServico = OrdemServico::where('contrato_id', $contrato->id)->get();

                // Recupere os IDs das ordens de serviço
                $idsOrdemServico = $ordensServico->pluck('id')->toArray();

                // Calcule as despesas para este contrato
                $despesasFluxoCaixa = FluxoCaixa::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('tipo', 'saida')
                    ->sum('valor');

                // Adicione as contas a pagar que ainda não foram pagas
                $contasNaoPagas = ContaAPagar::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('status', 'pendente')
                    ->sum('valor');



                $contasMovidasParaFluxo = FluxoCaixa::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('tipo', 'saida')
                    ->whereIn('id', ContaAPagar::whereIn('id_ordemServico', $idsOrdemServico)
                        ->where('status', 'pago')
                        ->pluck('id')
                    )
                    ->sum('valor');


                // Calcule o recebimento para este contrato
                $recebimento = FluxoCaixa::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('tipo', 'entrada')
                    ->sum('valor');

                // Some as despesas e o recebimento para este cliente
                $despesasCliente += $despesasFluxoCaixa + $contasNaoPagas - $contasMovidasParaFluxo;
                $recebimentoCliente += $recebimento;

                // Recupere todas as notas vinculadas a este cliente
                $notas = NotaFiscal::where('cnpj_tomador', $cliente->cnpj)->orWhere('nome_tomador', $cliente->nome)->get();

                // Recupere os IDs das notas vinculadas a este cliente
                $idsNotas = $notas->pluck('id')->toArray();

                // Verifique o status das notas na tabela status_notas
                $statusNotasPendentes = StatusNota::whereIn('nota_id', $idsNotas)
                    ->where('status', 'Pendente')
                    ->get();

                // Inicialize a variável para armazenar o valor total das notas pendentes
                $valorNFEmitida = 0;

                // Itere sobre a coleção de objetos StatusNota pendentes
                foreach ($statusNotasPendentes as $statusNota) {
                    // Recupere o ID da nota associada a este objeto
                    $notaId = $statusNota->nota_id;

                    // Consulte a tabela notasfiscais para obter o valor total da nota
                    $notaFiscal = NotaFiscal::find($notaId);

                    if ($notaFiscal) {
                        // Adicione o valor total da nota à variável
                        $valorNFEmitida += $notaFiscal->valorTotal;
                        //dd($notaFiscal->valorTotal);
                    }
                }


                // Calcule o lucro, faturamento total e margem de lucro para este cliente
                $lucro = $recebimentoCliente + $aReceberPrevisao + $valorNFEmitida - $despesasCliente;
                $faturamentoTotal = $recebimentoCliente + $valorNFEmitida + $aReceberPrevisao;
                $margemLucro = ($lucro / $faturamentoTotal) * 100;

                $painelControle->despesas = $despesasCliente;
                $painelControle->recebimento = $recebimentoCliente;
                $painelControle->a_receber_previsao = $aReceberPrevisao;
                $painelControle->valor_nf_emitida = $valorNFEmitida;
                $painelControle->lucro = $lucro;
                $painelControle->faturamento_total = $faturamentoTotal;
                $painelControle->margem_lucro = $margemLucro;

                $painelControle->save();

                // Adicione os dados do cliente e contratos ao array
                $dadosPainel[] = [
                    'id'=> $contrato->id,
                    'cliente' => $cliente->nome,
                    'contrato' => $contrato->nomeContrato,
                    'despesas' => $despesasCliente,
                    'recebimento' => $recebimentoCliente,
                    'a_receber_previsao' => $aReceberPrevisao,
                    'valor_nf_emitida' => $valorNFEmitida,
                    'lucro' => $lucro,
                    'faturamento_total' => $faturamentoTotal,
                    'margem_lucro' => $margemLucro,
                ];
            }
        }

        return view('painelcontrole.index', [
            'dadosPainel' => $dadosPainel
        ]);
    }


    public function edit(PainelControle $painel, )
    {
        return view('painelcontrole.edit', ['painel' => $painel]);
    }


    public function update(Request $request, $contratoId)
    {
        // Recupere o contrato com base no ID
        $contrato = Contrato::find($contratoId);

        if (!$contrato) {
            return redirect()->route('painelcontrole.index')->with('error', 'Contrato não encontrado.');
        }

        $cliente = $contrato->cliente;

        // Verifique o cliente e faça as atualizações necessárias na tabela PainelControle
        if ($cliente) {
            // Busque o PainelControle associado ao contrato pelo nome do contrato
            $painelControle = PainelControle::where('contrato', $contrato->nomeContrato)->first();


            if ($painelControle) {
                // Obtenha o valor formatado do campo 'valorOrdemServico'
                $valorFormatado = $request->input('a_receber_previsao');

                // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
                $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

                // Converta o valor para um tipo numérico
                $valorNumerico = (float) $valorFormatado;

                if ($valorNumerico <= 0) {
                    return redirect()->back()->with('error', 'O valor de "A Receber Previsão" não pode ser menor ou igual a 0.');
                }

                $painelControle->a_receber_previsao = $valorNumerico;

                $painelControle->save();
            }
        }

        return redirect()->route('painelcontrole.index')->with('success', 'Valor de "A Receber Previsão" atualizado com sucesso.');

    }

    private function processarRetirada($nomeContrato, $mesNumero, $anoAtual) {
        // Inicializa o valor da retirada
        $valorRetirada = 0;

        // Obtém todos os contratos com o nome de retirada correspondente
        $contratos = Contrato::where('nomeContrato', 'LIKE', '%' . $nomeContrato . '%')
            ->whereYear('dataInicio', $anoAtual)
            ->get();

        // Percorre todos os contratos encontrados
        foreach ($contratos as $contrato) {
            $ordensServico = $contrato->ordemservico;

            if (is_array($ordensServico) || is_object($ordensServico)){
                foreach ($ordensServico as $ordemServico) {
                    // Verifica se a ordem de serviço possui fluxo de caixa associado
                    if ($ordemServico->fluxoCaixas) {
                        $fluxoCaixasSaida = $ordemServico->fluxoCaixas
                            ->where('tipo', 'saida')
                            ->filter(function ($fluxoCaixa) use ($mesNumero) {
                                return date('m', strtotime($fluxoCaixa->data)) == $mesNumero;
                            });
                        foreach ($fluxoCaixasSaida as $fluxoCaixa) {
                            $valorRetirada += $fluxoCaixa->valor;
                        }
                    }
                }
            }

        }

        return $valorRetirada;
    }


    public function finMensal()
    {
        $anoAtual = date('Y');
        $anoAnterior = $anoAtual-1;

        $meses = [
            'Janeiro' => 1,
            'Fevereiro' => 2,
            'Março' => 3,
            'Abril' => 4,
            'Maio' => 5,
            'Junho' => 6,
            'Julho' => 7,
            'Agosto' => 8,
            'Setembro' => 9,
            'Outubro' => 10,
            'Novembro' => 11,
            'Dezembro' => 12,
        ];



        foreach ($meses as $mes => $mesNumero) {

            $faturamentoAnterior = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                ->whereYear('dataEmissao','=', $anoAnterior)
                ->sum('valorTotal');

            $faturamento = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                ->whereYear('dataEmissao','=', $anoAtual)
                ->sum('valorTotal');

            $recebimentoAnterior = NotaFiscal::join('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
                ->where('status', 'Pago')
                ->whereMonth('notasfiscais.dataEmissao', '=', $mesNumero)
                ->whereYear('notasfiscais.dataEmissao','=', $anoAnterior)
                ->sum('notasfiscais.valorTotal');

            $recebimento = NotaFiscal::join('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
                ->where('status', 'Pago')
                ->whereMonth('notasfiscais.dataEmissao', '=', $mesNumero)
                ->whereYear('notasfiscais.dataEmissao','=', $anoAtual)
                ->sum('notasfiscais.valorTotal');


            $despesasAnterior = FluxoCaixa::whereMonth('data', '=', $mesNumero)
                ->whereYear('data','=',$anoAnterior)
                ->where('tipo', 'saida')
                ->sum('valor');

            $despesas = FluxoCaixa::whereMonth('data', '=', $mesNumero)
                ->whereYear('data','=',$anoAtual)
                ->where('tipo', 'saida')
                ->sum('valor');


            $admAnterior = $this->processarRetirada('Retirada Administração', $mesNumero, $anoAnterior);
            $adm = $this->processarRetirada('Retirada Administração', $mesNumero, $anoAtual);
            $retiradaAnterior = $this->processarRetirada('Retirada Sócios', $mesNumero, $anoAnterior);
            $retirada = $this->processarRetirada('Retirada Sócios', $mesNumero, $anoAtual);
            $investimentoAnterior = $this->processarRetirada('Retirada Investimento', $mesNumero, $anoAnterior);
            $investimento = $this->processarRetirada('Retirada Investimento', $mesNumero, $anoAtual);
            $impostosAnterior = $this->processarRetirada('Retirada Impostos', $mesNumero, $anoAnterior);
            $impostos = $this->processarRetirada('Retirada Impostos', $mesNumero, $anoAtual);

            $percentAdm = ($faturamento > 0) ? ($adm / $faturamento) * 100 : 0;
            $percentRetirada = ($faturamento > 0) ? ($retirada / $faturamento) * 100 : 0;
            $percentInvestimento = ($faturamento > 0) ? ($investimento / $faturamento) * 100 : 0;
            $percentImpostos = ($faturamento > 0) ? ($impostos / $faturamento) * 100 : 0;

            // Cálculos para o ano anterior
            $percentAdmAnterior = ($faturamentoAnterior > 0) ? ($admAnterior / $faturamentoAnterior) * 100 : 0;
            $percentRetiradaAnterior = ($faturamentoAnterior > 0) ? ($retiradaAnterior / $faturamentoAnterior) * 100 : 0;
            $percentInvestimentoAnterior = ($faturamentoAnterior > 0) ? ($investimentoAnterior / $faturamentoAnterior) * 100 : 0;
            $percentImpostosAnterior = ($faturamentoAnterior > 0) ? ($impostosAnterior / $faturamentoAnterior) * 100 : 0;

            // Impostos retidos para o ano atual
            $impostosRetidos = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorIss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorPis')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorCofins')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorInss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorIr')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAtual)
                    ->sum('valorCsll');

            // Impostos retidos para o ano anterior
            $impostosRetidosAnterior = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorIss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorPis')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorCofins')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorInss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorIr')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorCsll');



            $percentImpostosRetidos = ($faturamento > 0) ? ($impostosRetidos / $faturamento) * 100 : 0;
            $percentImpostosRetidosAnterior = ($faturamentoAnterior > 0) ? ($impostosRetidosAnterior / $faturamentoAnterior) * 100 : 0;

            $percentualTotalImpostos = $percentImpostosRetidos + $percentImpostos;
            $percentualTotalImpostosAnterior = $percentImpostosRetidosAnterior + $percentImpostosAnterior;


            $lucro = $faturamento - $despesas - $impostosRetidos;
            $lucroAnterior = $faturamentoAnterior - $despesasAnterior - $impostosRetidosAnterior;


            $financeiro = Financeiro::firstOrNew([
                'mes' => $mes,
                'ano' => $anoAtual,

            ]);

            $financeiro->faturamento = $faturamento;
            $financeiro->recibemento = $recebimento;
            $financeiro->despesas = $despesas;
            $financeiro->adm = $adm;
            $financeiro->percentual_adm = round($percentAdm,2);
            $financeiro->retirada = $retirada;
            $financeiro->percentual_retirada = round($percentRetirada,2);
            $financeiro->investimento = $investimento;
            $financeiro->percentual_investimento = round($percentInvestimento,2);
            $financeiro->impostos_pagos = $impostos;
            $financeiro->percentual_impostos_pagos = round($percentImpostos,2);
            $financeiro->impostos_retidos = $impostosRetidos;
            $financeiro->percentual_impostos_retidos = round($percentImpostosRetidos,2);
            $financeiro->soma_percentual_impostos = round($percentualTotalImpostos,2);
            $financeiro->lucro = $lucro;

            $financeiro->save();
            $dadosFinanceiros[$anoAtual . '-' . $mes] = $financeiro;



            $financeiroAnterior = Financeiro::firstOrNew([
                'mes' => $mes,
                'ano' => $anoAnterior,

            ]);

            $financeiroAnterior->faturamento = $faturamentoAnterior;
            $financeiroAnterior->recibemento = $recebimentoAnterior;
            $financeiroAnterior->despesas = $despesasAnterior;
            $financeiroAnterior->adm = $admAnterior;
            $financeiroAnterior->percentual_adm = round($percentAdmAnterior,2);
            $financeiroAnterior->retirada = $retiradaAnterior;
            $financeiroAnterior->percentual_retirada = round($percentRetiradaAnterior,2);
            $financeiroAnterior->investimento = $investimentoAnterior;
            $financeiroAnterior->percentual_investimento = round($percentInvestimentoAnterior,2);
            $financeiroAnterior->impostos_pagos = $impostosAnterior;
            $financeiroAnterior->percentual_impostos_pagos = round($percentImpostosAnterior,2);
            $financeiroAnterior->impostos_retidos = $impostosRetidosAnterior;
            $financeiroAnterior->percentual_impostos_retidos = round($percentImpostosRetidosAnterior,2);
            $financeiroAnterior->soma_percentual_impostos = round($percentualTotalImpostosAnterior,2);
            $financeiroAnterior->lucro = $lucroAnterior;
            $financeiroAnterior->save();

            $dadosFinanceirosAnterior[$anoAnterior . '-' . $mes] = $financeiroAnterior;

        }
        return view('painelcontrole.mensal', compact('dadosFinanceiros'));
    }

    public function finMensalAnterior()
    {
        $anoAtual = date('Y');
        $anoAnterior = $anoAtual-1;

        $meses = [
            'Janeiro' => 1,
            'Fevereiro' => 2,
            'Março' => 3,
            'Abril' => 4,
            'Maio' => 5,
            'Junho' => 6,
            'Julho' => 7,
            'Agosto' => 8,
            'Setembro' => 9,
            'Outubro' => 10,
            'Novembro' => 11,
            'Dezembro' => 12,
        ];



        foreach ($meses as $mes => $mesNumero) {

            $faturamentoAnterior = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                ->whereYear('dataEmissao','=', $anoAnterior)
                ->sum('valorTotal');


            $recebimentoAnterior = NotaFiscal::join('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
                ->where('status', 'Pago')
                ->whereMonth('notasfiscais.dataEmissao', '=', $mesNumero)
                ->whereYear('notasfiscais.dataEmissao','=', $anoAnterior)
                ->sum('notasfiscais.valorTotal');


            $despesasAnterior = FluxoCaixa::whereMonth('data', '=', $mesNumero)
                ->whereYear('data','=',$anoAnterior)
                ->where('tipo', 'saida')
                ->sum('valor');

            $admAnterior = $this->processarRetirada('Retirada Administração', $mesNumero, $anoAnterior);

            $retiradaAnterior = $this->processarRetirada('Retirada Sócios', $mesNumero, $anoAnterior);

            $investimentoAnterior = $this->processarRetirada('Retirada Investimento', $mesNumero, $anoAnterior);
            dd($investimentoAnterior);

            $impostosAnterior = $this->processarRetirada('Retirada Impostos', $mesNumero, $anoAnterior);



            // Cálculos para o ano anterior
            $percentAdmAnterior = ($faturamentoAnterior > 0) ? ($admAnterior / $faturamentoAnterior) * 100 : 0;
            $percentRetiradaAnterior = ($faturamentoAnterior > 0) ? ($retiradaAnterior / $faturamentoAnterior) * 100 : 0;
            $percentInvestimentoAnterior = ($faturamentoAnterior > 0) ? ($investimentoAnterior / $faturamentoAnterior) * 100 : 0;
            $percentImpostosAnterior = ($faturamentoAnterior > 0) ? ($impostosAnterior / $faturamentoAnterior) * 100 : 0;

            // Impostos retidos para o ano anterior
            $impostosRetidosAnterior = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorIss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorPis')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorCofins')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorInss')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorIr')
                + NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                    ->whereYear('dataEmissao', '=', $anoAnterior)
                    ->sum('valorCsll');

            $percentImpostosRetidosAnterior = ($faturamentoAnterior > 0) ? ($impostosRetidosAnterior / $faturamentoAnterior) * 100 : 0;

            $percentualTotalImpostosAnterior = $percentImpostosRetidosAnterior + $percentImpostosAnterior;


            $lucroAnterior = $faturamentoAnterior - $despesasAnterior - $impostosRetidosAnterior;

            $financeiroAnterior = Financeiro::firstOrNew([
                'mes' => $mes,
                'ano' => $anoAnterior,

            ]);

            $financeiroAnterior->faturamento = $faturamentoAnterior;
            $financeiroAnterior->recibemento = $recebimentoAnterior;
            $financeiroAnterior->despesas = $despesasAnterior;
            $financeiroAnterior->adm = $admAnterior;
            $financeiroAnterior->percentual_adm = round($percentAdmAnterior,2);
            $financeiroAnterior->retirada = $retiradaAnterior;
            $financeiroAnterior->percentual_retirada = round($percentRetiradaAnterior,2);
            $financeiroAnterior->investimento = $investimentoAnterior;
            $financeiroAnterior->percentual_investimento = round($percentInvestimentoAnterior,2);
            $financeiroAnterior->impostos_pagos = $impostosAnterior;
            $financeiroAnterior->percentual_impostos_pagos = round($percentImpostosAnterior,2);
            $financeiroAnterior->impostos_retidos = $impostosRetidosAnterior;
            $financeiroAnterior->percentual_impostos_retidos = round($percentImpostosRetidosAnterior,2);
            $financeiroAnterior->soma_percentual_impostos = round($percentualTotalImpostosAnterior,2);
            $financeiroAnterior->lucro = $lucroAnterior;
            $financeiroAnterior->save();

            $dadosFinanceirosAnterior[$anoAnterior . '-' . $mes] = $financeiroAnterior;

        }

        return view('painelcontrole.mensalanterior', compact('dadosFinanceirosAnterior'));
    }







}
