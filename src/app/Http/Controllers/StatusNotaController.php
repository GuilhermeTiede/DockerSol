<?php

namespace App\Http\Controllers;

use App\Models\StatusNota;
use Illuminate\Http\Request;

class StatusNotaController extends Controller
{

    public readonly StatusNota $statusNota;
    public function __construct()
    {
        $this->statusNota = new StatusNota();

    }

    public function index()
    {
        $statusnotas = $this->statusNota->all();
        return view('notasfiscais.index', ['statusnotas' => $statusnotas]);
    }

    public function create()
    {
        return view('notasfiscais.create');
    }


    public function store(Request $request)
    {
        $created = $this->statusNota->create([
            'nota_id' => $request->nota_id,
            'status' => $request->status
        ]);

        if($created){
            return redirect()->back()->with('message', 'Nota Fiscal cadastrada com sucesso!');
        }else{
            return redirect()->back()->with('error', 'Falha ao cadastrar nota fiscal!');
        }
    }


    public function show(StatusNota $statusnota)
    {
        return view('notasfiscais.show', ['statusnota' => $statusnota]);
    }


    public function edit(StatusNota $statusnota)
    {
        return view('notasfiscais.edit', ['statusnota' => $statusnota]);
    }


    public function update(Request $request, string $id)
    {
        $update  = $this->statusNota->find($id)->update($request->except('_token', '_method'));
        if($update) {
            return redirect()->back()->with('message', 'Nota Fiscal atualizada com sucesso!');
        } else {
            return redirect()->back()->with('error', 'Falha ao atualizar Nota Fiscal!');
        }

    }


    public function destroy(string $id)
    {
        $delete = $this->statusNota->find($id)->delete();
        if($delete) {
            return redirect()->route('notasfiscais.index')->with('message', 'Nota Fiscal deletada com sucesso!');
        }else{
            return redirect()->route('notasfiscais.index')->with('error', 'Falha ao deletar Nota Fiscal!');
        }
    }

    public function atualizarStatusNota(Request $request, $id)
    {
        $statusNota = StatusNota::where('nota_id', $id)->first();

        if (!$statusNota) {
            return redirect()->back()->with('error', 'Status da nota não encontrado');
        }

        $statusNota->status = $request->status;
        $statusNota->save();

        return redirect()->back()->with('message', 'Status da nota atualizado com sucesso');
    }


}
