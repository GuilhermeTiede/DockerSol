<?php

namespace App\Http\Controllers;

use App\Models\FontePagadora;
use Illuminate\Http\Request;

class FontesPagadorasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public readonly FontePagadora $fontePagadora;
    public function __construct()
    {
        $this->fontePagadora = new FontePagadora();

    }

    public function index()
    {
        $fontespagadoras = $this->fontePagadora->all();
        return view('fontespagadoras.index', ['fontespagadoras' => $fontespagadoras]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('fontespagadoras.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            $request->validate([
                'agencia' => 'required',
                'conta' => 'required',
                'banco' => 'required',
                'tipoConta' => 'required',
                'nomeTitular' => 'required',
            ]);
        $created = $this->fontePagadora->create([
            'agencia' => $request->agencia,
            'conta' => $request->conta,
            'banco' => $request->banco,
            'tipoConta' => $request->tipoConta,
            'nomeTitular' => $request->nomeTitular,
        ]);

        if ($created) {
            return redirect()->back()->with('message', 'Fonte Pagadora cadastrada com sucesso!');
        }
        }  catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(FontePagadora $fontepagadora)
    {
        return view('fontespagadoras.show', ['fontepagadora' => $fontepagadora]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FontePagadora $fontepagadora)
    {
        return view('fontespagadoras.edit', ['fontepagadora' => $fontepagadora]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $request->validate([
                'agencia' => 'required',
                'conta' => 'required',
                'banco' => 'required',
                'tipoConta' => 'required',
                'nomeTitular' => 'required',
            ]);
            $update  = $this->fontePagadora->find($id)->update($request->except('_token', '_method'));
            if($update) {
                return redirect()->back()->with('message', 'Fonte Pagadora atualizada com sucesso!');
            } else {
                return redirect()->back()->with('error', 'Falha ao atualizar fonte pagadora!');
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $delete = $this->fontePagadora->find($id)->delete();
        if($delete) {
            return redirect()->back()->with('message', 'Fonte Pagadora excluída com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao excluir fonte pagadora!');
        }
    }
}
