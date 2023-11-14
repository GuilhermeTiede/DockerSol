<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class EmpresasController extends Controller
{

    public readonly Empresa $empresa;
    public function __construct()
    {
        $this->empresa = new Empresa();
    }


    public function index()
    {
        $empresas = $this->empresa->all();
        return view('empresas.empresas',['empresas' => $empresas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('empresas.empresas_create');

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // Validação personalizada para verificar se o CNPJ já existe
            $cnpjExistente = $this->empresa->where('cnpj', $request->cnpj)->exists();

            if ($cnpjExistente) {
                throw ValidationException::withMessages(['cnpj' => 'Já existe uma empresa com este CNPJ.']);
            }

            $request->validate([
                'nome' => 'required',
                'cnpj' => 'required',
                'endereco' => 'required',
            ]);

            //nome is required
            $created = Empresa::create([
                'nome' => $request->nome,
                'cnpj' => $request->cnpj,
                'endereco' => $request->endereco,
            ]);

            if ($created) {
                return redirect()->back()->with('message', 'Empresa cadastrada com sucesso!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
        return redirect()->back()->with('error', 'Falha ao cadastrar empresa!')->withInput();
    }

    /**
     * Display the specified resource.
     */
    public function show(Empresa $empresa)
    {
        return view('empresas.empresas_show', ['empresa' => $empresa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Empresa $empresa)
    {
        return view('empresas.empresas_edit', ['empresa' => $empresa]);
    }


    public function update(Request $request, string $id)
    {
        try {
        $request->validate([
            'nome' => 'required',
            'cnpj' => 'required',
            'endereco' => 'required',
        ]);

        $update = $this->empresa->find($id)->update($request->except('_token', '_method'));

        if($update) {
            return redirect()->back()->with('message', 'Empresa atualizada com sucesso!');
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
        $delete = $this->empresa->find($id)->delete();
        if($delete) {
            return redirect()->back()->with('message', 'Empresa excluída com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao excluir empresa!');
        }
    }
}
