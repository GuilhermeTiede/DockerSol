<?php

use App\Http\Controllers\ContasAPagarController;
use App\Http\Controllers\ContratosController;
use App\Http\Controllers\DocumentosContratosController;
use App\Http\Controllers\EmpresasController;
use App\Http\Controllers\FontesPagadorasController;
use App\Http\Controllers\MotoristasController;
use App\Http\Controllers\OrdemServicoController;
use App\Http\Controllers\PainelControleController;
use App\Http\Controllers\StatusNotaController;
use App\Http\Controllers\VeiculosController;
use Illuminate\Support\Facades\Route;
use Collective\Html\HtmlFacade as HTML;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ClientesController;
use App\Http\Controllers\NotasFiscaisController;
use App\Http\Controllers\FluxoCaixasController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
//Route::get('/dashboard', function () {
//    return view('dashboard');
//})->name('dashboard');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {

    Route::get('/', function () {
        $controller = new NotasFiscaisController();
        $data = $controller->gerarGraficoFaturamentoPorMes();

        return view('example-app', ['data' => $data]);
    });

    //Rotas de Clientes
    Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index');
    Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create');
    Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store');
    Route::get('/clientes/{cliente}', [ClientesController::class, 'show'])->name('clientes.show');
    Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit');
    Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update');
    Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy');

    //Rotas de Empresas
    Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresas.index');
    Route::get('/empresas/create', [EmpresasController::class, 'create'])->name('empresas.create');
    Route::post('/empresas', [EmpresasController::class, 'store'])->name('empresas.store');
    Route::get('/empresas/{empresa}', [EmpresasController::class, 'show'])->name('empresas.show');
    Route::get('/empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit');
    Route::put('/empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update');
    Route::delete('/empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy');

    //Rotas de Contratos
    Route::get('/contratos', [ContratosController::class, 'index'])->name('contratos.index');
    Route::get('/contratos/create', [ContratosController::class, 'create'])->name('contratos.create');
    Route::post('/contratos', [ContratosController::class, 'store'])->name('contratos.store');
    Route::get('/contratos/{contrato}', [ContratosController::class, 'show'])->name('contratos.show');
    Route::get('/contratos/{contrato}/edit', [ContratosController::class, 'edit'])->name('contratos.edit');
    Route::put('/contratos/{contrato}', [ContratosController::class, 'update'])->name('contratos.update');
    Route::delete('/contratos/{contrato}', [ContratosController::class, 'destroy'])->name('contratos.destroy');


    Route::post('/upload-documento', [DocumentosContratosController::class, 'uploadDocumento'])->name('upload.documento');


    //Rotas Fontes Pagadoras
    Route::get('/fontespagadoras', [FontesPagadorasController::class, 'index'])->name('fontespagadoras.index');
    Route::get('/fontespagadoras/create', [FontesPagadorasController::class, 'create'])->name('fontespagadoras.create');
    Route::post('/fontespagadoras', [FontesPagadorasController::class, 'store'])->name('fontespagadoras.store');
    Route::get('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'show'])->name('fontespagadoras.show');
    Route::get('/fontespagadoras/{fontepagadora}/edit', [FontesPagadorasController::class, 'edit'])->name('fontespagadoras.edit');
    Route::put('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'update'])->name('fontespagadoras.update');
    Route::delete('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'destroy'])->name('fontespagadoras.destroy');


    //Rotas Veiculos
    Route::get('/veiculos', [VeiculosController::class, 'index'])->name('veiculos.index');
    Route::get('/veiculos/create', [VeiculosController::class, 'create'])->name('veiculos.create');
    Route::post('/veiculos', [VeiculosController::class, 'store'])->name('veiculos.store');
    Route::get('/veiculos/{veiculo}', [VeiculosController::class, 'show'])->name('veiculos.show');
    Route::get('/veiculos/{veiculo}/edit', [VeiculosController::class, 'edit'])->name('veiculos.edit');
    Route::put('/veiculos/{veiculo}', [VeiculosController::class, 'update'])->name('veiculos.update');
    Route::delete('/veiculos/{veiculo}', [VeiculosController::class, 'destroy'])->name('veiculos.destroy');

    //Rotas Contas a Pagar
    Route::get('/contasapagar', [ContasAPagarController::class, 'index'])->name('contasapagar.index');
    Route::get('/contasapagar/create', [ContasAPagarController::class, 'create'])->name('contasapagar.create');
    Route::post('/contasapagar', [ContasAPagarController::class, 'store'])->name('contasapagar.store');
    Route::get('/contasapagar/{conta}', [ContasAPagarController::class, 'show'])->name('contasapagar.show');
    Route::get('/contasapagar/{conta}/edit', [ContasAPagarController::class, 'edit'])->name('contasapagar.edit');
    Route::put('/contasapagar/{conta}', [ContasAPagarController::class, 'update'])->name('contasapagar.update');
    Route::delete('/contasapagar/{conta}', [ContasAPagarController::class, 'destroy'])->name('contasapagar.destroy');
    Route::post('/contasapagar/{conta}/mudarstatus', [ContasAPagarController::class, 'mudarStatus'])->name('contasapagar.mudarstatus');


    //Rotas Notas Fiscais
    Route::get('/notasfiscais', [NotasFiscaisController::class, 'index'])->name('notasfiscais.index');
    Route::get('/notasfiscais/create', [NotasFiscaisController::class, 'create'])->name('notasfiscais.create');
    Route::post('/notasfiscais', [NotasFiscaisController::class, 'store'])->name('notasfiscais.store');
    Route::get('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'show'])->name('notasfiscais.show');
    Route::get('/notasfiscais/{notafiscal}/edit', [NotasFiscaisController::class, 'edit'])->name('notasfiscais.edit');
    Route::put('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'update'])->name('notasfiscais.update');
    Route::delete('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'destroy'])->name('notasfiscais.destroy');

    Route::post('/upload-notafiscal', [NotasFiscaisController::class, 'uploadNota'])->name('upload.notafiscal');
    Route::post('/status-notafiscal/{notafiscal}', [NotasFiscaisController::class, 'statusNota'])->name('status.notafiscal');

    //Rotas Ordem de Servico
    Route::get('/ordensservico', [OrdemServicoController::class,'index'])->name('ordensservicos.index');
    Route::get('/ordensservico/create', [OrdemServicoController::class,'create'])->name('ordensservicos.create');
    Route::post('/ordensservico', [OrdemServicoController::class,'store'])->name('ordensservicos.store');
    Route::get('/ordensservico/{ordemServico}', [OrdemServicoController::class,'show'])->name('ordensservicos.show');
    Route::get('/ordensservico/{ordemServico}/edit', [OrdemServicoController::class,'edit'])->name('ordensservicos.edit');
    Route::put('/ordensservico/{ordemServico}', [OrdemServicoController::class,'update'])->name('ordensservicos.update');
    Route::delete('/ordensservico/{ordemServico}', [OrdemServicoController::class,'destroy'])->name('ordensservicos.destroy');


    //Rotas FluxoCaixa
    Route::get('/fluxocaixa', [FluxoCaixasController::class,'index'])->name('fluxocaixas.index');
    Route::get('/fluxocaixa/create', [FluxoCaixasController::class,'create'])->name('fluxocaixas.create');
    Route::post('/fluxocaixa', [FluxoCaixasController::class,'store'])->name('fluxocaixas.store');
    Route::get('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'show'])->name('fluxocaixas.show');
    Route::get('/fluxocaixa/{fluxoCaixa}/edit', [FluxoCaixasController::class,'edit'])->name('fluxocaixas.edit');
    Route::put('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'update'])->name('fluxocaixas.update');
    Route::delete('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'destroy'])->name('fluxocaixas.destroy');

    Route::get('/get-ordem-servico-por-contrato', [FluxoCaixasController::class,'getOrdemServicoPorContrato']);

    //Rotas Motoristas
    Route::get('/motoristas', [MotoristasController::class, 'index'])->name('motoristas.index');
    Route::get('/motoristas/create', [MotoristasController::class, 'create'])->name('motoristas.create');
    Route::post('/motoristas', [MotoristasController::class, 'store'])->name('motoristas.store');
    Route::get('/motoristas/{motorista}', [MotoristasController::class, 'show'])->name('motoristas.show');
    Route::get('/motoristas/{motorista}/edit', [MotoristasController::class, 'edit'])->name('motoristas.edit');
    Route::put('/motoristas/{motorista}', [MotoristasController::class, 'update'])->name('motoristas.update');
    Route::delete('/motoristas/{motorista}', [MotoristasController::class, 'destroy'])->name('motoristas.destroy');


    //Rotas Painel de Controlle
    Route::get('/painelcontrole', [PainelControleController::class, 'index'])->name('painelcontrole.index');
    Route::get('/painelcontrole/mensal', [PainelControleController::class, 'finMensal'])->name('painelcontrole.mensal');
    Route::put('/painelcontrole/{contrato}', [PainelControleController::class, 'update'])->name('painelcontrole.update');
});

