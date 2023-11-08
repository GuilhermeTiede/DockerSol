@extends('layouts.page-layout')
@section('pageTitle', isset($pageTitle) ? $pageTitle : 'Notas Ficais')
@section('actualPage', 'Notas Fiscais')
@section('button', 'Nova Nota Fiscal')
@section('link', route('notasfiscais.create'))

@section('content')
    <table id="fontespagadoras" class="data-table table stripe hover nowrap">
        <thead>
        <tr>
            <th>Nf</th>
            <th>Pertencente</th>
            <th>Dias Faltantes</th>
            <th>Valor da Nota</th>
            <th>Status</th>
            <th>Ações</th>
        </tr>
        </thead>
        <tbody>
        @foreach ($notasfiscais as $notafiscal)
            <tr>
                <td>{{$notafiscal->numeroNf }}</td>
                <td>{{$notafiscal->nome_prestador}}</td>
                <td>
                    @php
                        $hoje = time();
                        $dataPrevisaoPagamento = strtotime($notafiscal->dataPrevisaoPagamento); // Substitua pelo nome correto do campo no seu modelo
                        $diasFaltantes = ceil(($dataPrevisaoPagamento - $hoje) / 86400);

						if ($diasFaltantes < 0) {
                        echo "Pagamento " . (-$diasFaltantes) . " dias atrasado";
                    } else {
                        echo  $diasFaltantes;
                    }
                    @endphp
                </td>
                <td>
                    @php
                        $valorTotalFormatado = number_format($notafiscal->valorTotal, 2, ',', '.');
                    @endphp
                    {{"R$".$valorTotalFormatado}}
                </td>
                <td>
                    @php
                        // Recupere o status da nota fiscal
                        $statusNota = App\Models\StatusNota::where('nota_id', $notafiscal->id)->first();
                        if ($statusNota) {
                            echo $statusNota->status;
                        } else {
                            echo "Sem Status";
                        }
                    @endphp
                </td>
                <td>
                    <a class="btn btn-primary" href="{{ route('notasfiscais.show', ['notafiscal' => $notafiscal->id]) }}">Visualizar</a>
                    <a class="btn btn-info" href="{{ route('notasfiscais.edit', ['notafiscal' => $notafiscal->id]) }}">Editar</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
@endsection
