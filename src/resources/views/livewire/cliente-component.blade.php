<div class="pd-20 card-box mb-30">
    <h4 class="text-blue h4">Lista de Clientes</h4>
    <table id="tabelaClientes" class="table table-bordered">
        <!-- Cabeçalho da tabela ... -->
        <thead>
        <tr>
            <th>Nome</th>
            <th>CNPJ</th>
            <th>Estado</th>
            <th>Município</th>
            <th>Logradouro</th>
            <th>Número</th>
            <th>CEP</th>
        </tr>
        </thead>
        <tbody>
        <!-- Linhas da tabela preenchidas com os dados dos clientes ... -->
        @foreach($clientes as $cliente)
            <tr>
                <td>{{ $cliente->nome }}</td>
                <td>{{ $cliente->cnpj }}</td>
                <td>{{ $cliente->estado }}</td>
                <td>{{ $cliente->municipio }}</td>
                <td>{{ $cliente->logradouro }}</td>
                <td>{{ $cliente->numero }}</td>
                <td>{{ $cliente->cep }}</td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>
@push('scripts')
    @push('scripts')
        <script>
            document.addEventListener('livewire:load', function () {
                Livewire.on('atualizarTabela', () => {
                    $('#tabelaClientes').DataTable().ajax.reload(); // Recarrega os dados da DataTable via Ajax
                });
            });
        </script>
    @endpush
@endpush
