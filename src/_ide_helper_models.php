<?php

// @formatter:off
/**
 * A helper file for your Eloquent Models
 * Copy the phpDocs from this file to the correct Model,
 * And remove them from this file, to prevent double declarations.
 *
 * @author Barry vd. Heuvel <barryvdh@gmail.com>
 */


namespace App\Models{
/**
 * App\Models\Cliente
 *
 * @property int $id
 * @property string $nome
 * @property string $cnpj
 * @property string|null $estado
 * @property string|null $municipio
 * @property string|null $logradouro
 * @property string|null $numero
 * @property string|null $cep
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $empresa_id
 * @property-read \App\Models\Empresa $empresa
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente query()
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCep($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEmpresaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereEstado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereLogradouro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereMunicipio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereNumero($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Cliente whereUpdatedAt($value)
 */
	class Cliente extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\ContaAPagar
 *
 * @property int $id
 * @property string $tipo
 * @property string $descricao
 * @property string $valor
 * @property string|null $dataVencimento
 * @property string|null $dataPagamento
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int|null $id_ordemServico
 * @property int|null $id_fontePagadora
 * @property-read \App\Models\Contrato|null $contrato
 * @property-read \App\Models\FontePagadora|null $fontePagadora
 * @property-read \App\Models\OrdemServico|null $ordemServico
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar query()
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereDataPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereDataVencimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereIdFontePagadora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereIdOrdemServico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|ContaAPagar whereValor($value)
 */
	class ContaAPagar extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Contrato
 *
 * @property int $id
 * @property int $cliente_id
 * @property string $nomeContrato
 * @property string $numeroContrato
 * @property \Illuminate\Support\Carbon $dataInicio
 * @property \Illuminate\Support\Carbon $dataFim
 * @property string $valorContrato
 * @property string $seguroGarantia
 * @property string $responsabilidadeTecnica
 * @property string|null $observacao
 * @property bool|null $renovado
 * @property \Illuminate\Support\Carbon|null $dataRenovacao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Cliente $cliente
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\DocumentosContrato> $documentoscontrato
 * @property-read int|null $documentoscontrato_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\OrdemServico> $ordensServico
 * @property-read int|null $ordens_servico_count
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereClienteId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereDataFim($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereDataInicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereDataRenovacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereNomeContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereNumeroContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereObservacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereRenovado($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereResponsabilidadeTecnica($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereSeguroGarantia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Contrato whereValorContrato($value)
 */
	class Contrato extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\DocumentosContrato
 *
 * @property int $id
 * @property int $contrato_id
 * @property string $nomeDocumento
 * @property string $dataDocumento
 * @property string|null $dataVencimento
 * @property string $tipoDocumento
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contrato $contrato
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato query()
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereContratoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereDataDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereDataVencimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereNomeDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereTipoDocumento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|DocumentosContrato whereUpdatedAt($value)
 */
	class DocumentosContrato extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Empresa
 *
 * @property int $id
 * @property string $nome
 * @property string $cnpj
 * @property string|null $endereco
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Cliente> $clientes
 * @property-read int|null $clientes_count
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa query()
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCnpj($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereEndereco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Empresa whereUpdatedAt($value)
 */
	class Empresa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Financeiro
 *
 * @property int $id
 * @property string|null $mes
 * @property int|null $ano
 * @property string|null $faturamento
 * @property string|null $recibemento
 * @property string|null $despesas
 * @property string|null $adm
 * @property string|null $percentual_adm
 * @property string|null $retirada
 * @property string|null $percentual_retirada
 * @property string|null $investimento
 * @property string|null $percentual_investimento
 * @property string|null $impostos_pagos
 * @property string|null $percentual_impostos_pagos
 * @property string|null $impostos_retidos
 * @property string|null $percentual_impostos_retidos
 * @property string|null $soma_percentual_impostos
 * @property string|null $lucro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro query()
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereAdm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereAno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereDespesas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereFaturamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereImpostosPagos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereImpostosRetidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereInvestimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereLucro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro wherePercentualAdm($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro wherePercentualImpostosPagos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro wherePercentualImpostosRetidos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro wherePercentualInvestimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro wherePercentualRetirada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereRecibemento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereRetirada($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereSomaPercentualImpostos($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Financeiro whereUpdatedAt($value)
 */
	class Financeiro extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FluxoCaixa
 *
 * @property int $id
 * @property int $id_ordemServico
 * @property int $id_fontePagadora
 * @property string $tipo
 * @property string $valor
 * @property string|null $observacao
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $data
 * @property-read \App\Models\Contrato $contrato
 * @property-read \App\Models\FontePagadora|null $fontePagadora
 * @property-read \App\Models\OrdemServico|null $ordemServico
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa query()
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereIdFontePagadora($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereIdOrdemServico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereObservacao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereTipo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FluxoCaixa whereValor($value)
 */
	class FluxoCaixa extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\FontePagadora
 *
 * @property int $id
 * @property string $agencia
 * @property string $conta
 * @property string $banco
 * @property string $tipoConta
 * @property string $nomeTitular
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora query()
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereAgencia($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereBanco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereConta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereNomeTitular($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereTipoConta($value)
 * @method static \Illuminate\Database\Eloquent\Builder|FontePagadora whereUpdatedAt($value)
 */
	class FontePagadora extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Motorista
 *
 * @property int $id
 * @property string $nome
 * @property string $cpf
 * @property string $rg
 * @property string $cnh
 * @property string $categoriaCnh
 * @property string|null $endereco
 * @property string|null $telefone
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\Veiculo> $veiculos
 * @property-read int|null $veiculos_count
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista query()
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereCategoriaCnh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereCnh($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereCpf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereEndereco($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereNome($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereRg($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereTelefone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Motorista whereUpdatedAt($value)
 */
	class Motorista extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\NotaFiscal
 *
 * @property int $id
 * @property string $numeroNf
 * @property string $dataEmissao
 * @property string $dataPrevisaoPagamento
 * @property string $mes
 * @property string $exercicio
 * @property float $valorTotal
 * @property float $valorIss
 * @property float $valorPis
 * @property float $valorCofins
 * @property float $valorInss
 * @property float $valorIr
 * @property float $valorCsll
 * @property string $descricao
 * @property string $cnpj_prestador
 * @property string $nome_prestador
 * @property string|null $cnpj_tomador
 * @property string|null $nome_tomador
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal query()
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereCnpjPrestador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereCnpjTomador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereDataEmissao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereDataPrevisaoPagamento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereDescricao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereExercicio($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereMes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereNomePrestador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereNomeTomador($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereNumeroNf($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorCofins($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorCsll($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorInss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorIr($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorIss($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorPis($value)
 * @method static \Illuminate\Database\Eloquent\Builder|NotaFiscal whereValorTotal($value)
 */
	class NotaFiscal extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\OrdemServico
 *
 * @property int $id
 * @property int $contrato_id
 * @property string $valorOrdemServico
 * @property string $dataOrdemServico
 * @property string $numeroOrdemServico
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Contrato $contrato
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \App\Models\FluxoCaixa> $fluxoCaixas
 * @property-read int|null $fluxo_caixas_count
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico query()
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereContratoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereDataOrdemServico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereNumeroOrdemServico($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|OrdemServico whereValorOrdemServico($value)
 */
	class OrdemServico extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\PainelControle
 *
 * @property int $id
 * @property string $contrato
 * @property string $despesas
 * @property string $recebimento
 * @property string $a_receber_previsao
 * @property string $valor_nf_emitida
 * @property string $lucro
 * @property string|null $imposto_previsto
 * @property string|null $adm_fixo
 * @property string $faturamento_total
 * @property string $margem_lucro
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle query()
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereAReceberPrevisao($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereAdmFixo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereContrato($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereDespesas($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereFaturamentoTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereImpostoPrevisto($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereLucro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereMargemLucro($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereRecebimento($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|PainelControle whereValorNfEmitida($value)
 */
	class PainelControle extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\StatusNota
 *
 * @property int $id
 * @property int $nota_id
 * @property string $status
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\NotaFiscal $notaFiscal
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota query()
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota whereNotaId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|StatusNota whereUpdatedAt($value)
 */
	class StatusNota extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property int|null $current_team_id
 * @property string|null $profile_photo_path
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $two_factor_secret
 * @property string|null $two_factor_recovery_codes
 * @property string|null $two_factor_confirmed_at
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection<int, \Illuminate\Notifications\DatabaseNotification> $notifications
 * @property-read int|null $notifications_count
 * @property-read \Illuminate\Database\Eloquent\Collection<int, \Laravel\Sanctum\PersonalAccessToken> $tokens
 * @property-read int|null $tokens_count
 * @method static \Database\Factories\UserFactory factory($count = null, $state = [])
 * @method static \Illuminate\Database\Eloquent\Builder|User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|User query()
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereCurrentTeamId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereProfilePhotoPath($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorConfirmedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorRecoveryCodes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereTwoFactorSecret($value)
 * @method static \Illuminate\Database\Eloquent\Builder|User whereUpdatedAt($value)
 */
	class User extends \Eloquent {}
}

namespace App\Models{
/**
 * App\Models\Veiculo
 *
 * @property int $id
 * @property int $id_motorista
 * @property string $placa
 * @property string $renavam
 * @property string $chassi
 * @property string|null $modelo
 * @property string|null $marca
 * @property string|null $ano
 * @property string|null $cor
 * @property string|null $tipoCombustivel
 * @property string|null $tipoVeiculo
 * @property string|null $categoriaVeiculo
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Models\Motorista $motorista
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo query()
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereAno($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCategoriaVeiculo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereChassi($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCor($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereIdMotorista($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereMarca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereModelo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo wherePlaca($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereRenavam($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTipoCombustivel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereTipoVeiculo($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Veiculo whereUpdatedAt($value)
 */
	class Veiculo extends \Eloquent {}
}

