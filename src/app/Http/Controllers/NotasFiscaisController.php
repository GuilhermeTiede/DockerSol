<?php

namespace App\Http\Controllers;
use App\Models\Contrato;
use App\Models\FluxoCaixa;
use App\Models\FontePagadora;
use App\Models\NotaFiscal;
use App\Models\OrdemServico;
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
        $ordemServicos = OrdemServico::all();
        $statusNotas = StatusNota::all();



            return view('notasfiscais.show', [
                'notafiscal' => $notafiscal,
                'fontePagadoras' => $fontePagadoras,
                'contratos' => $contratos,
                'ordemServicos' => $ordemServicos,
                'statusNotas' => $statusNotas,
            ]);


    }



    public function edit(NotaFiscal $notafiscal)
    {
        return view('notasfiscais.edit', ['notafiscal' => $notafiscal]);
    }


    public function update(Request $request, string $id)
    {
        try{
        $update  = $this->notaFiscal->find($id)->update($request->except('_token', '_method'));

        if($update) {
            return redirect()->back()->with('message', 'Nota Fiscal atualizada com sucesso!');
        }

        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
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

            $notaFiscal = $this->notaFiscal->find($notafiscal);
//            dd($notaFiscal);

            if (!$notaFiscal) {
                return redirect()->back()->with('error', 'Nota Fiscal não encontrada!');
            }

            $statusNota = StatusNota::firstOrNew(['nota_id' => $notaFiscal->id]);
            $statusNota->status = $request->status;
            $statusNota->contrato_id = $request->id_contrato;
            $statusNota->ordemservico_id = $request->id_ordemServico;
            $statusNota->fontepagadora_id = $request->id_fontePagadora;
            $statusNota->data = $request->dataPagamento;

            $statusNota->save();

            if ($request->status === 'Pago') {
                // Criar um registro no fluxo de caixa
                $fluxoCaixa = new FluxoCaixa();
                $fluxoCaixa->id_ordemServico = $request->id_ordemServico;
                $fluxoCaixa->id_fontePagadora = $request->id_fontePagadora;
                $fluxoCaixa->tipo = 'entrada';
                $fluxoCaixa->valor = $notaFiscal->valorTotal;
                $fluxoCaixa->observacao = 'Nota Fiscal paga: ' . $notaFiscal->nome_tomador;
                $fluxoCaixa->data = $request->dataPagamento;
                $fluxoCaixa->save();
            } else {
                $statusNota->save();
            }

            return redirect()->back()->with('message', 'Status da Nota Fiscal atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    private function getTipoXML($xml)
    {
        // Verificar o namespace do XML para determinar o tipo
        $namespace = $xml->getDocNamespaces(true);

        if (isset($namespace[''])) {
            $xmlNamespace = $namespace[''];
        } else {
            return null;
        }

        // Verificar o tipo de XML com base no namespace
        if ($xmlNamespace === 'http://www.centi.com.br/files/nfse.xsd') {
            return 'NFSe';
        } elseif ($xmlNamespace === 'urn:oasis:names:tc:opendocument:xmlns:office:1.0') {
            return 'ODG';
        } elseif ($xmlNamespace === 'http://openoffice.org/2009/office') {
            return 'OpenOffice';
        } elseif ($xmlNamespace === 'http://nfse.goiania.go.gov.br/xsd/nfse_gyn_v02.xsd') {
            return 'NFSe_GYN';
        } else {
            return null;
        }
    }

    public function uploadNota2(Request $request)
    {
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $destino = "(uploads/notas)";

            // Carrega o XML
            $xml = simplexml_load_string(file_get_contents($documento->path()));

            // Verifica se o arquivo é válido
            if ($documento->isValid() && $xml) {
                $nomeDocumento = $documento->getClientOriginalName();

                // Identifica o tipo de XML
                $tipoXML = $this->getTipoXML($xml);

                // Chama a função de processamento específica para o tipo de XML identificado
                if ($tipoXML) {
                    $funcaoProcessamento = 'processar' . $tipoXML;
                    $resultado = $this->$funcaoProcessamento($xml);
                    if ($resultado) {
                        if ($documento->storeAs($destino, $nomeDocumento)) {
                            return redirect()->back()->with('message', 'Documento cadastrado com sucesso!');
                        } else {
                            return redirect()->back()->with('error', 'Falha ao Salvar documento!');
                        }
                    } else {
                        return redirect()->back()->with('error', 'Falha ao processar o XML!');
                    }
                } else {
                    return redirect()->back()->with('error', 'Tipo de XML não suportado!');
                }
            } else {
                return redirect()->back()->with('error', 'Arquivo inválido ou tipo de XML não suportado!');
            }
        } else {
            return redirect()->back()->with('error', 'Nenhum arquivo foi enviado!');
        }
    }

    private function processarNFSe($xml)
    {

        try {
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

            $notafiscal->save();

            return true;
        } catch (\Exception $e) {
            return false;
        }
    }

    private function processarODG($xml)
    {

        return true;
    }

    private function processarOpenOffice($xml)
    {

        return true;
    }

    private function processarNFSe_GYN($xml)
    {
        try {
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
            $valores = $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Servico->Valores;
            $notafiscal->valorTotal = (float) $valores->ValorServicos;
            $notafiscal->valorIss = (float) $valores->ValorIss;
            $notafiscal->valorPis = (float) $valores->ValorPis;
            $notafiscal->valorCofins = (float) $valores->ValorCofins;
            $notafiscal->valorInss = (float) $valores->ValorInss;
            $notafiscal->valorIr = (float) $valores->ValorIr;
            $notafiscal->valorCsll = (float) $valores->ValorCsll;
            $notafiscal->descricao = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->ServicoDiscriminacao;
            $formatarCnpj = $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Prestador->CpfCnpj->Cnpj;
            $parte1 = substr($formatarCnpj, 0, 2);
            $parte2 = substr($formatarCnpj, 2, 3);
            $parte3 = substr($formatarCnpj, 5, 3);
            $parte4 = substr($formatarCnpj, 8, 4);
            $parte5 = substr($formatarCnpj, 12);
            $cnpjFormatado = "{$parte1}.{$parte2}.{$parte3}/{$parte4}-{$parte5}";
            $notafiscal->cnpj_prestador = $cnpjFormatado ?? null;
            $notafiscal->nome_prestador = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Prestador->InscricaoMunicipal;
            $formatarCnpjTomador = $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Tomador->IdentificacaoTomador->CpfCnpj->Cnpj;
            $parte1Tomador = substr($formatarCnpjTomador, 0, 2);
            $parte2Tomador = substr($formatarCnpjTomador, 2, 3);
            $parte3Tomador = substr($formatarCnpjTomador, 5, 3);
            $parte4Tomador = substr($formatarCnpjTomador, 8, 4);
            $parte5Tomador = substr($formatarCnpjTomador, 12);
            $cnpjFormatadoTomador = "{$parte1Tomador}.{$parte2Tomador}.{$parte3Tomador}/{$parte4Tomador}-{$parte5Tomador}";
            $notafiscal->cnpj_tomador = $cnpjFormatadoTomador ?? null;
            $notafiscal->nome_tomador = (string) $nfse->DeclaracaoPrestacaoServico->InfDeclaracaoPrestacaoServico->Tomador->RazaoSocial;
            $notafiscal->save();

            return true;
        }catch (\Exception $e){
            dd($e->getMessage());

            return false;
        }
    }

    public function uploadNota(Request $request)
    {
        if ($request->hasFile('documento')) {
            $documento = $request->file('documento');
            $destino = "uploads/notas";

            // Carrega o XML da nota fiscal
            $xml = simplexml_load_string(file_get_contents($documento->path()), null, 0, 'http://www.centi.com.br/files/nfse.xsd');
            if (!$xml) {
                return redirect()->back()->with('error', 'Erro ao abrir arquivo XML!');
            }
            // Verifica se o arquivo é válido
            if ($documento->isValid()) {
                $nomeDocumento = $documento->getClientOriginalName();

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

                        if ($documento->storeAs($destino, $nomeDocumento)) {
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
