<?php

namespace App\Http\Controllers;

use App\Models\Motorista;
use Illuminate\Http\Request;

class MotoristasController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    public readonly Motorista $motorista;
    public function __construct()
    {
        $this->motorista = new Motorista();

    }

    public function index()
    {
        $motoristas = $this->motorista->all();
        return view('motoristas.index', ['motoristas' => $motoristas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('motoristas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'nome' => 'required',
                'cpf' => 'required|digits:11',
                'cnh' => 'required|max:11',
                'rg' => 'required|max:9',
                'categoriaCnh' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
            ]);

            $created = Motorista::create([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'cnh' => $request->cnh,
                'rg' => $request->rg,
                'categoriaCnh' => $request->categoriaCnh,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
            ]);
            if ($created) {
                return redirect()->back()->with('message', 'Motorista cadastrado com sucesso!');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Motorista $motorista)
    {
        return view('motoristas.show', ['motorista' => $motorista]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Motorista $motorista)
    {
        return view('motoristas.edit', ['motorista' => $motorista]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $motorista = $this->motorista->find($id);

            $request->validate([
                'nome' => 'required',
                'cpf' => 'required|digits:11',
                'cnh' => 'required|digits:11',
                'rg' => 'required|max:9',
                'categoriaCnh' => 'required',
                'telefone' => 'required',
                'endereco' => 'required',
            ]);

            $updated = $motorista->update([
                'nome' => $request->nome,
                'cpf' => $request->cpf,
                'cnh' => $request->cnh,
                'rg' => $request->rg,
                'categoriaCnh' => $request->categoriaCnh,
                'telefone' => $request->telefone,
                'endereco' => $request->endereco,
                $request->except('_token', '_method')
            ]);

            if ($updated) {
                return redirect()->back()->with('message', 'Motorista atualizado com sucesso!');
            }
        }catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->motorista->find($id)->delete();
            return redirect()->back()->with('message', 'Motorista excluído com sucesso!');
        }catch ( \Exception $e){
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }
}
