<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Cliente;
class ClienteComponent extends Component
{
    public $atualizarTabela = false;
    protected $listeners = ['clienteCriado' => 'atualizarClientes'];


    public function render()
    {
        $clientes = Cliente::all();
        return view('livewire.cliente-component', compact('clientes'));
    }
    public function atualizarTabela()
    {
        $this->atualizarTabela = true;
    }

}
