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
        try {
            $request->validate([
                'id_motorista' => 'required',
                'placa' => 'required:digits:7',
                'renavam' => 'required|max:11',
                'chassi' => 'required|max:17',
                'modelo' => 'required',
                'marca' => 'required',
                'ano' => 'required',
                'cor' => 'required',
                'tipoCombustivel' => 'required',
                'tipoVeiculo' => 'required',
                'categoriaVeiculo' => 'required',
            ]);

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
            }
        }catch (\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

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
        try {
            $request->validate([
                'placa' => 'required:digits:7',
                'renavam' => 'required|max:11',
                'chassi' => 'required|max:17',
                'modelo' => 'required',
                'marca' => 'required',
                'ano' => 'required',
                'cor' => 'required',
                'tipoCombustivel' => 'required',
                'tipoVeiculo' => 'required',
                'categoriaVeiculo' => 'required',
            ]);
            $updated = $this->veiculo->find($id)->update($request->except('_token', '_method'));
            if($updated) {
                return redirect()->back()->with('message', 'Veiculo atualizado com sucesso!');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
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
