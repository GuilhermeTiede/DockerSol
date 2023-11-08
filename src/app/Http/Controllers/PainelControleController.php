<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\NotaFiscal;
use App\Models\OrdemServico;
use App\Models\PainelControle;
use App\Models\StatusNota;
use Illuminate\Http\Request;
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

        //$aReceberPrevisao = 1;

        // Itere sobre cada cliente para calcular os dados
        foreach ($clientes as $cliente) {
            // Verifique se já existe um registro na tabela para este cliente
            $painelControle = PainelControle::firstOrNew(['contrato' => $cliente->nome]);

            // Se o valor de "A Receber Previsão" não estiver definido, use o valor padrão
            if ($painelControle->a_receber_previsao === null) {
                $aReceberPrevisao = 1; // Substitua pelo valor real
            } else {
                $aReceberPrevisao = $painelControle->a_receber_previsao;
            }

            // Recupere todos os contratos vinculados a este cliente
            $contratos = Contrato::where('cliente_id', $cliente->id)->get();

            // Inicialize as variáveis de despesas e recebimento para cada cliente
            $despesasCliente = 0;
            $recebimentoCliente = 0;

            // Itere sobre os contratos deste cliente para calcular despesas e recebimento
            foreach ($contratos as $contrato) {
                // Recupere as ordens de serviço vinculadas a este contrato
                $ordensServico = OrdemServico::where('contrato_id', $contrato->id)->get();

                // Recupere os IDs das ordens de serviço
                $idsOrdemServico = $ordensServico->pluck('id')->toArray();

                // Calcule as despesas para este contrato
                $despesas = FluxoCaixa::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('tipo', 'saida')
                    ->sum('valor');

                // Calcule o recebimento para este contrato
                $recebimento = FluxoCaixa::whereIn('id_ordemServico', $idsOrdemServico)
                    ->where('tipo', 'entrada')
                    ->sum('valor');

                // Some as despesas e o recebimento para este cliente
                $despesasCliente += $despesas;
                $recebimentoCliente += $recebimento;
            }


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

            // Adicione os dados do cliente e contratos ao array
            $dadosPainel[] = [
                'id'=> $cliente->id,
                'cliente' => $cliente->nome,
                'despesas' => $despesasCliente,
                'recebimento' => $recebimentoCliente,
                'a_receber_previsao' => $aReceberPrevisao,
                'valor_nf_emitida' => $valorNFEmitida,
                'lucro' => $lucro,
                'faturamento_total' => $faturamentoTotal,
                'margem_lucro' => $margemLucro,
            ];


            $painelControle->despesas = $despesasCliente;
            $painelControle->recebimento = $recebimentoCliente;
            $painelControle->a_receber_previsao = $aReceberPrevisao;
            $painelControle->valor_nf_emitida = $valorNFEmitida;
            $painelControle->lucro = $lucro;
            $painelControle->faturamento_total = $faturamentoTotal;
            $painelControle->margem_lucro = $margemLucro;

            $painelControle->save();

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
        // Recupere o contrato com base no cliente_id
        $contrato = Contrato::where('cliente_id', $contratoId)->first();


        if (!$contrato) {
            return redirect()->route('painelcontrole.index')->with('error', 'Contrato não encontrado.');
        }

        $cliente = $contrato->cliente;



        // Verifique o cliente e faça as atualizações necessárias na tabela PainelControle
        if ($cliente) {
            // Por exemplo, para atualizar "A Receber Previsão" na tabela PainelControle
            $painelControle = PainelControle::where('contrato', $cliente->nome)->first();

            if ($painelControle) {
                // Obtenha o valor formatado do campo 'valorOrdemServico'
                $valorFormatado = $request->input('a_receber_previsao');

                // Remova o prefixo 'R$ ' e substitua vírgulas por pontos
                $valorFormatado = str_replace(['.', ','], ['', '.'], $valorFormatado);

                // Converta o valor para um tipo numérico
                $valorNumerico = (float) $valorFormatado;

                $painelControle->a_receber_previsao = $valorNumerico;

                $painelControle->save();
            }
        }

        return redirect()->route('painelcontrole.index')->with('success', 'Valor de "A Receber Previsão" atualizado com sucesso.');

    }




//    public function indexMensal()
//    {
//
//        $anoVigencia = now()->year;
//
//        $tiposContratos = [
//            'Retirada Administração',
//            'Retirada Sócios',
//            'Retirada Investimento',
//            'Retirada Impostos',
//        ];
//
//        $dadosPainelMensal = [];
//
//        // Itera sobre os tipos de contratos
//        foreach ($tiposContratos as $tipoContrato) {
//
//
//            $nomeContrato = $tipoContrato . ' ' . $anoVigencia;
//
//            $tipoContratoFluxo = 'saida';
//            $contratos = FluxoCaixa::where('tipo', $tipoContratoFluxo)
//                ->whereYear('data', $anoVigencia)
//                ->get();
//
//            // Calcula o valor total para este tipo de contrato
//            $valorTotalContrato = $contratos->sum('valor'); // Substitua pelo campo correto
//
//            // Inicializa as variáveis de valores
//            $admin = 0;
//            $percentAdmin = 0;
//            $retirada = 0;
//            $percentRetirada = 0;
//            $investimento = 0;
//            $percentInvestimento = 0;
//            $valorImpostos = 0;
//            $percentImpostosPagos = 0;
//            $valorPis = 0;
//            $valorCofins = 0;
//            $valorInss = 0;
//            $valorIr = 0;
//            $valorCsll = 0;
//
//            foreach ($contratos as $contrato) {
//
//                $dataContrato = date_create($contrato->data);
//
//                // Obtém o mês da data do contrato formatado em português
//                $mes = $dataContrato->format('F');
//
//
//                // Lógica para cálculo das retiradas de Administração, Sócios e Investimento
//                if ($tipoContrato === 'Retirada Administração') {
//                    $admin += $contrato->valor;
//                } elseif ($tipoContrato === 'Retirada Sócios') {
//                    $retirada += $contrato->valor;
//                } elseif ($tipoContrato === 'Retirada Investimento') {
//                    $investimento += $contrato->valor;
//                }
//                // Lógica para cálculo dos Impostos Pagos
//                if ($tipoContrato === 'Retirada Impostos') {
//                    // Substitua pelas lógicas reais para calcular impostos
//                    $valorPis = 0;
//                    $valorCofins = 0;
//                    $valorInss = 0;
//                    $valorIr = 0;
//                    $valorCsll = 0;
//
//                    $valorImpostos = $valorPis + $valorCofins + $valorInss + $valorIr + $valorCsll;
//                    $percentImpostosPagos = ($valorImpostos / $valorTotalContrato) * 100;
//                }
//            }
//
//            $valorTotalContrato = $admin + $retirada + $investimento;
//            $valorImpostos = $valorPis + $valorCofins + $valorInss + $valorIr + $valorCsll;
//
//            if ($valorTotalContrato > 0) {
//                $percentAdmin = ($admin / $valorTotalContrato) * 100;
//                $percentRetirada = ($retirada / $valorTotalContrato) * 100;
//                $percentInvestimento = ($investimento / $valorTotalContrato) * 100;
//                $percentImpostosPagos = ($valorImpostos / $valorTotalContrato) * 100;
//            } else {
//                $percentAdmin = 0;
//                $percentRetirada = 0;
//                $percentInvestimento = 0;
//                $percentImpostosPagos = 0;
//            }
//
//            // Calcula o valor das despesas para este mês
//            $despesas = FluxoCaixa::whereYear('data', $anoVigencia)
//                ->whereMonth('data', $mes)
//                ->where('tipo', 'saida')
//                ->sum('valor');
//
//            // Calcula o valor do resultado do mês
//            $resultadoMes = $valorTotalContrato - $despesas - $valorImpostos;
//
//            // Adicione os dados do tipo de contrato ao array
//            $dadosPainelMensal[] = [
//                'mes' => $mes,
//                'tipo_contrato' => $tipoContrato,
//                'valor_total_contrato' => $valorTotalContrato,
//                'admin' => $admin,
//                'percent_admin' => $percentAdmin,
//                'retirada' => $retirada,
//                'percent_retirada' => $percentRetirada,
//                'investimento' => $investimento,
//                'percent_investimento' => $percentInvestimento,
//                'impostos_pagos' => $valorImpostos,
//                'percent_impostos_pagos' => $percentImpostosPagos,
//                'impostos_retidos' => $valorPis + $valorCofins + $valorInss + $valorIr + $valorCsll,
//                'percent_impostos_retidos' => (($valorTotalContrato - $admin - $retirada - $investimento) / 1) * 100,
//                'resultado_mes' => $resultadoMes,
//            ];
//        }
//
//        return view('painelcontrole.mensal', [
//            'dadosPainelMensal' => $dadosPainelMensal,
//        ]);
//    }

    private function processarRetirada($nomeContrato, $mesNumero, $anoAtual) {
        // Inicializa o valor da retirada
        $valorRetirada = 0;

        // Obtém todos os contratos com o nome de retirada correspondente
        $contratos = Contrato::where('nomeContrato', 'LIKE', '%' . $nomeContrato . '%')
            ->whereYear('dataInicio', $anoAtual)
            ->get();

        // Percorre todos os contratos encontrados
        foreach ($contratos as $contrato) {
            $ordensServico = $contrato->ordensServico;

            foreach ($ordensServico as $ordemServico) {
                // Verifica se a ordem de serviço possui fluxo de caixa associado
                if ($ordemServico->fluxoCaixas) {
                    $fluxoCaixasSaida = $ordemServico->fluxoCaixas
                        ->where('tipo', 'saida')
                        ->filter(function ($fluxoCaixa) use ($mesNumero) {
                            return date('m', strtotime($fluxoCaixa->data)) == $mesNumero;
                        });

                    // Soma o valor dos fluxoCaixas de saída
                    foreach ($fluxoCaixasSaida as $fluxoCaixa) {
                        $valorRetirada += $fluxoCaixa->valor;
                    }
                }
            }
        }

        return $valorRetirada;
    }




    public function finMensal()
    {
        $anoAtual = date('Y');

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
            $faturamento = NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                ->whereYear('dataEmissao','=', $anoAtual)
                ->sum('valorTotal');

            $recebimento = NotaFiscal::join('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
                ->where('status', 'Pago')
                ->whereMonth('notasfiscais.dataEmissao', '=', $mesNumero)
                ->whereYear('notasfiscais.dataEmissao','=', $anoAtual)
                ->sum('notasfiscais.valorTotal');

            $despesas = FluxoCaixa::whereMonth('data', '=', $mesNumero)
                ->whereYear('data','=',$anoAtual)
                ->where('tipo', 'saida')
                ->sum('valor');

            $adm = $this->processarRetirada('Retirada Administração', $mesNumero, $anoAtual);
            $retirada = $this->processarRetirada('Retirada Sócios', $mesNumero, $anoAtual);
            $investimento = $this->processarRetirada('Retirada Investimento', $mesNumero, $anoAtual);
            $impostos = $this->processarRetirada('Retirada Impostos', $mesNumero, $anoAtual);

            $percentAdm = ($faturamento > 0) ? ($adm / $faturamento) * 100 : 0;
            $percentRetirada = ($faturamento > 0) ? ($retirada / $faturamento) * 100 : 0;
            $percentInvestimento = ($faturamento > 0) ? ($investimento / $faturamento) * 100 : 0;
            $percentImpostos = ($faturamento > 0) ? ($impostos / $faturamento) * 100 : 0;

            $impostosRetidos =  NotaFiscal::whereMonth('dataEmissao', '=', $mesNumero)
                ->sum('valorIss',
                    'valorPis',
                    'valorCofins',
                    'valorInss',
                    'valorIr',
                    'valorCsll'
                );

            $percentImpostosRetidos = ($faturamento > 0) ? ($impostosRetidos / $faturamento) * 100 : 0;

            $percentualTotalImpostos = $percentImpostosRetidos + $percentImpostos;

            $lucro = $faturamento - $despesas - $impostosRetidos;


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

            $dadosFinanceiros[] = $financeiro;

        }
        return view('painelcontrole.mensal', compact('dadosFinanceiros'));
    }








}
