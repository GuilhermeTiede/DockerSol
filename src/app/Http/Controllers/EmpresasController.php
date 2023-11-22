<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\NotaFiscal;
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
    private function verificarCnpjNotaFiscal($cnpjEmpresa)
    {
        $notasFiscais = NotaFiscal::where('cnpj_prestador', $cnpjEmpresa)->get();

        return $notasFiscais->isNotEmpty();
    }

    public function destroy(string $id)
    {
        try {
            $empresa = $this->empresa->find($id);
            //Se cnpj empresa existir em NotasFiscais cnpj_prestador, jogar erro na tela que nao pode excluir
            if (!$empresa) {
                throw new \Exception('Empresa não encontrada');
            }
            $cnpjEmpresa = $empresa->cnpj;
            $existeNotaFiscal = $this->verificarCnpjNotaFiscal($cnpjEmpresa);

            if ($existeNotaFiscal) {
                throw new \Exception('Não é possível excluir a empresa, pois o CNPJ está vinculado a Notas Fiscais como CNPJ prestador.');
            }
            $empresa->delete();
            return redirect()->route('empresas.index')>with('message', 'Empresa excluída com sucesso!');

        } catch (\Exception $e) {
            return redirect()->route('empresas.index')->with('error', $e->getMessage());
        }

    }
}
