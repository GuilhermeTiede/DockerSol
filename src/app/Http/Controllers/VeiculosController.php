<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Motorista;
use Illuminate\Http\Request;
use App\Models\Veiculo;



class VeiculosController extends Controller
{
    public readonly Veiculo $veiculo;
    public function __construct()
    {
        $this->veiculo = new Veiculo();
    }
    public function index()
    {
        $veiculos = $this->veiculo->all();
        return view('veiculos.index',['veiculos' => $veiculos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $veiculos = $this->veiculo->all();
        $motoristas = Motorista::all();
        return view('veiculos.create',['veiculos' => $veiculos],['motoristas' => $motoristas]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $created = $this->veiculo->create([
            'id_motorista' => $request->id_motorista,
            'placa' => $request->placa,
            'renavam' => $request->renavam,
            'chassi' => $request->chassi,
            'modelo' => $request->modelo,
            'marca' => $request->marca,
            'ano' => $request->ano,
            'cor' => $request->cor,
            'tipoCombustivel' => $request->tipoCombustivel,
            'tipoVeiculo' => $request->tipoVeiculo,
            'categoriaVeiculo' => $request->categoriaVeiculo,
        ]);

        if ($created) {
            return redirect()->back()->with('message', 'Veiculo cadastrado com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao cadastrar veiculo!');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Veiculo $veiculo)
    {
        $motoristas = Motorista::all();
        return view('veiculos.show', ['veiculo' => $veiculo],['motoristas' => $motoristas]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Veiculo $veiculo)
    {
        $motoristas = Motorista::all();
        return view('veiculos.edit', ['veiculo' => $veiculo] ,['motoristas' => $motoristas]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $updated = $this->veiculo->find($id)->update($request->except('_token', '_method'));
        if($updated){
            return redirect()->back()->with('message', 'Veiculo atualizado com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Falha ao atualizar veiculo!');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->veiculo->find($id)->delete();
        return redirect()->route('veiculos.index');

    }
}
