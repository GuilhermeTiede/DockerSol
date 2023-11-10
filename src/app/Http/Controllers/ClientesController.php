<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class ClientesController extends Controller
{
    public readonly Cliente $cliente;

    public function __construct()
    {
        $this->cliente = new Cliente();
    }

    public function index()
    {
        $clientes = $this->cliente->all();

        return view('clientes.index', ['clientes' => $clientes]);
    }


    public function create( Cliente $cliente )

    {
        $clientes = $this->cliente->all();
        $empresas = Empresa::all();

        return view('clientes.create', ['clientes' => $clientes], ['empresas' => $empresas]);
    }

    public function store( Request $request )
    {
        try {

            $request->validate([
                'nome' => 'required',
                'cnpj' => 'required',
                'estado' => 'required',
                'municipio' => 'required',
                'logradouro' => 'required',
                'numero' => 'required',
                'cep' => 'required',
                'empresa_id' => 'required',
            ]);

            $created = $this->cliente->create([
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
                'estado' => $request->estado,
                'municipio' => $request->municipio,
                'logradouro' => $request->logradouro,
                'numero' => $request->numero,
                'cep' => $request->cep,
                'empresa_id' => $request->empresa_id,
            ]);

            if ($created) {
                return redirect()->back()->with('message', 'Cliente cadastrado com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Falha ao cadastrar cliente!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }


    public function show( Cliente $cliente )
    {
        $empresas = Empresa::all();
        return view('clientes.show', ['cliente' => $cliente], ['empresas' => $empresas]);
    }

    public function edit(Cliente $cliente)
    {
        try {
            // Verifica se o cliente existe
            if (!$cliente) {
                throw new \Exception('Cliente não encontrado');
            }

            $empresas = Empresa::all();

            return view('clientes.edit', ['cliente' => $cliente, 'empresas' => $empresas]);
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }


    public function update(Request $request, string $id)
    {
        try {
            // Encontra o cliente pelo ID
            $cliente = $this->cliente->find($id);

            // Verifica se o cliente existe
            if (!$cliente) {
                throw new \Exception('Cliente não encontrado');
            }

            $request->validate([
                'nome' => 'required',
                'cnpj' => 'required',
                'estado' => 'required',
                'municipio' => 'required',
                'logradouro' => 'required',
                'numero' => 'required',
                'cep' => 'required',
                'empresa_id' => 'required',
            ]);

            $updated = $cliente->update($request->except('_token', '_method'));

            if ($updated) {
                return redirect()->back()->with('message', 'Cliente atualizado com sucesso!');
            } else {
                throw new \Exception('Falha ao atualizar cliente!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    public function destroy( string $id )
    {
        $deleted = $this->cliente->find($id)->delete();
        return redirect()->route('clientes.index');

    }

}
