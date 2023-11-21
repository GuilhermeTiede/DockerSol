<?php

namespace App\Http\Controllers;
use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\FontePagadora;
use App\Models\NotaFiscal;
use App\Models\StatusNota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Validator;

class NotasFiscaisController extends Controller
{

    public readonly NotaFiscal $notaFiscal;
    public function __construct()
    {
        $this->notaFiscal = new NotaFiscal();

    }

    public function index()
    {
        $notasfiscais = $this->notaFiscal->all();
        return view('notasfiscais.index', ['notasfiscais' => $notasfiscais]);
    }

    public function create()
    {
        return view('notasfiscais.create');
    }


    public function store(Request $request)
    {
        $created = $this->notaFiscal->create([
            'numeroNf' => $request->numeroNf,
            'dataEmissao' => $request->dataEmissao,
            'dataPrevisaoPagamento' => $request->dataPrevisaoPagamento,
            'mes' => $request->mes,
            'exercicio' => $request->exercicio,
            'valorTotal' => $request->valorTotal,
            'valorISS' => $request->valorISS,
            'valorPis' => $request->valorPis,
            'valorCofins' => $request->valorCofins,
            'valorInss' => $request->valorInss,
            'valorIr' => $request->valorIr,
            'valorCsll' => $request->valorCsll,
            'descricao' => $request->descricao,
            'cnpj_prestador' => $request->cnpj_prestador,
            'nome_prestador' => $request->nome_prestador,
            'cnpj_tomador' => $request->cnpj_tomador,
            'nome_tomador' => $request->nome_tomador,
        ]);

        if($created){
            return redirect()->back()->with('message', 'Nota Fiscal cadastrada com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Falha ao cadastrar nota fiscal!');
        }
    }


    public function show(NotaFiscal $notafiscal)
    {
        $fontePagadoras = FontePagadora::all();
        $contratos = Contrato::all();

        return view('notasfiscais.show', [
            'notafiscal' => $notafiscal,
            'fontePagadoras' => $fontePagadoras,
            'contratos' => $contratos,

        ]);
    }


    public function edit(NotaFiscal $notafiscal)
    {
        return view('notasfiscais.edit', ['notafiscal' => $notafiscal]);
    }


    public function update(Request $request, string $id)
    {
        $update  = $this->notaFiscal->find($id)->update($request->except('_token', '_method'));
        if($update) {
            return redirect()->back()->with('message', 'Nota Fiscal atualizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao atualizar Nota Fiscal!');
        }

    }


    public function destroy(string $id)
    {
        $delete = $this->notaFiscal->find($id)->delete();
        if($delete) {
            return redirect()->route('notasfiscais.index')->with('message', 'Nota Fiscal deletada com sucesso!');
        }else{
            return redirect()->route('notasfiscais.index')->with('error', 'Falha ao deletar Nota Fiscal!');
        }
    }

    public function statusNota(Request $request, $notafiscal)
    {
        try {
            $validator = Validator::make($request->all(), [
                'status' => 'required',
                'id_ordemServico' => 'required',
                'id_fontePagadora' => 'required',
                'dataPagamento' => 'required|date',
            ]);

            if ($validator->fails()) {
                throw new \Exception('Erro de validação. Por favor, verifique os campos e tente novamente.');
            }

            $notaFiscal = $this->notaFiscal->find($notafiscal);

            if (!$notaFiscal) {
                return redirect()->back()->with('error', 'Nota Fiscal não encontrada!');
            }

            $statusNota = StatusNota::where('nota_id', $notaFiscal->id)->first();

            if ($statusNota) {
                $statusNota->status = $request->status;
                $statusNota->save();

                if ($request->status === 'Pago') {
                    $fluxoCaixa = new FluxoCaixa();
                    $fluxoCaixa->id_ordemServico = $request->id_ordemServico;
                    $fluxoCaixa->id_fontePagadora = $request->id_fontePagadora;
                    $fluxoCaixa->tipo = 'entrada';
                    $fluxoCaixa->valor = $notaFiscal->valorTotal;
                    $fluxoCaixa->observacao = 'Nota Fiscal paga: ' . $notaFiscal->nome_tomador;
                    $fluxoCaixa->data = $request->dataPagamento;
                    $fluxoCaixa->save();
                }

                return redirect()->back()->with('message', 'Status da Nota Fiscal atualizado com sucesso!');
            } else {
                $novoStatus = new StatusNota();
                $novoStatus->nota_id = $notaFiscal->id;
                $novoStatus->status = $request->status;
                $novoStatus->save();

                return redirect()->back()->with('message', 'Status da Nota Fiscal criado com sucesso!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }



    public function uploadNota(Request $request)
    {
        // Verifica se o arquivo foi enviado corretamente
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $destino = '/root/DockerSol/src/public/uploads/notas';

            // Carrega o XML da nota fiscal
            $xml = simplexml_load_string(file_get_contents($documento->path()), null, 0, 'http://www.centi.com.br/files/nfse.xsd');
            if (!$xml) {
                return redirect()->back()->with('error', 'Erro ao abrir arquivo XML!');
            }

            // Verifica se o arquivo é válido
            if ($documento->isValid()) {
                $nomeDocumento = $documento->getClientOriginalName();

                // Salva o arquivo no destino
                if ($documento->move($destino, $nomeDocumento)) {
                    $notafiscal = new NotaFiscal();
                    $nfse = $xml->ListaNfse->CompNfse->Nfse->InfNfse;
                    $notafiscal->numeroNf = $xml->ListaNfse->CompNfse->Nfse->InfNfse->Numero;
                    $dataEmissao = date("Y-m-d", strtotime($nfse->DataEmissao));
                    $notafiscal->dataEmissao =$dataEmissao;
                    $date = $xml->ListaNfse->CompNfse->Nfse->InfNfse->DataEmissao;
                    $dataPrevisaoPagamento = date("Y-m-d", strtotime("+30 days", strtotime($nfse->DataEmissao)));
                    $notafiscal->dataPrevisaoPagamento = $dataPrevisaoPagamento;
                    $mes = date("m", strtotime($nfse->DataEmissao));
                    $notafiscal->mes = $mes;
                    $exercicio = date("Y", strtotime($nfse->DataEmissao));
                    $notafiscal->exercicio = $exercicio;
                    $notafiscal->valorTotal = (float) $nfse->ValoresNfse->ValorServicos;
                    $notafiscal->valorIss = (float) $nfse->ValoresNfse->ValorIss;
                    $notafiscal->valorPis = (float) $nfse->ValoresNfse->ValorPis;
                    $notafiscal->valorCofins = (float) $nfse->ValoresNfse->ValorCofins;
                    $notafiscal->valorInss = (float) $nfse->ValoresNfse->ValorInss;
                    $notafiscal->valorIr = (float) $nfse->ValoresNfse->ValorIr;
                    $notafiscal->valorCsll = (float) $nfse->ValoresNfse->ValorCsll;
                    $notafiscal->descricao = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Servico->Discriminacao;
                    $notafiscal->cnpj_prestador = $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Prestador->CpfCnpj->Cnpj ?? null;
                    $notafiscal->nome_prestador = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Prestador->RazaoSocial;
                    $notafiscal->cnpj_tomador = $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Tomador->IdentificacaoTomador->CpfCnpj->Cnpj ?? null;
                    $notafiscal->nome_tomador = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Tomador->RazaoSocial;

                    if ($notafiscal->save()) {
                        return redirect()->back()->with('message', 'Nota Fiscal cadastrada com sucesso!');
                    } else {
                        return redirect()->back()->with('error', 'Falha ao cadastrar Nota Fiscal!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Falha ao anexar Nota Fiscal!');
                }
            } else {
                return redirect()->back()->with('error', 'Arquivo inválido!');
            }
        } else {
            return redirect()->back()->with('error', 'Nenhum arquivo foi enviado!');
        }

    }


    public function gerarGraficoFaturamentoPorMes()
    {
        $data = DB::table('notasfiscais')
            ->leftJoin('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
            ->select(
                DB::raw("SUM(CASE WHEN status_notas.status = 'Pago' THEN \"valorTotal\" ELSE 0 END) as pago"),
                DB::raw("SUM(CASE WHEN status_notas.status = 'Pendente' THEN \"valorTotal\" ELSE 0 END) as pendente"),
                DB::raw("TO_CHAR(\"dataEmissao\", 'YYYY-MM') as mes"),
                'dataEmissao' // Inclua a coluna dataEmissao no SELECT
            )
            ->groupBy('mes', 'dataEmissao') // Adicione a coluna dataEmissao ao GROUP BY
            ->orderBy('mes')
            ->get();

        return $data;


    }

    public function gerarGraficoChart11()
    {
        $data = DB::table('notasfiscais')
            ->join('status_notas', 'notasfiscais.id', '=', 'status_notas.nota_id')
            ->select('status_notas.status', DB::raw('SUM(notasfiscais.valorTotal) as faturamento'))
            ->groupBy('status_notas.status')
            ->get();

        return view('example-app', compact('data'));
    }




}
