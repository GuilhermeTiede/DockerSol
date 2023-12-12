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

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

        //Rotas de Clientes
        Route::get('/clientes', [ClientesController::class, 'index'])->name('clientes.index')->middleware('can:clientes');
        Route::get('/clientes/create', [ClientesController::class, 'create'])->name('clientes.create')->middleware('can:clientes');
        Route::post('/clientes', [ClientesController::class, 'store'])->name('clientes.store')->middleware('can:clientes');
        Route::get('/clientes/{cliente}', [ClientesController::class, 'show'])->name('clientes.show')->middleware('can:clientes');
        Route::get('/clientes/{cliente}/edit', [ClientesController::class, 'edit'])->name('clientes.edit')->middleware('can:clientes');
        Route::put('/clientes/{cliente}', [ClientesController::class, 'update'])->name('clientes.update')->middleware('can:clientes');
        Route::delete('/clientes/{cliente}', [ClientesController::class, 'destroy'])->name('clientes.destroy')->middleware('can:clientes');

        //Rotas de Empresas
        Route::get('/empresas', [EmpresasController::class, 'index'])->name('empresas.index')->middleware('can:admin');
        Route::get('/empresas/create', [EmpresasController::class, 'create'])->name('empresas.create')->middleware('can:admin');
        Route::post('/empresas', [EmpresasController::class, 'store'])->name('empresas.store')->middleware('can:admin');
        Route::get('/empresas/{empresa}', [EmpresasController::class, 'show'])->name('empresas.show')->middleware('can:admin');
        Route::get('/empresas/{empresa}/edit', [EmpresasController::class, 'edit'])->name('empresas.edit')->middleware('can:admin');
        Route::put('/empresas/{empresa}', [EmpresasController::class, 'update'])->name('empresas.update')->middleware('can:admin');
        Route::delete('/empresas/{empresa}', [EmpresasController::class, 'destroy'])->name('empresas.destroy')->middleware('can:admin');

        //Rotas de Contratos
        Route::get('/contratos', [ContratosController::class, 'index'])->name('contratos.index')->middleware('can:contratos');
        Route::get('/contratos/create', [ContratosController::class, 'create'])->name('contratos.create')->middleware('can:contratos');
        Route::post('/contratos', [ContratosController::class, 'store'])->name('contratos.store')->middleware('can:contratos');
        Route::get('/contratos/{contrato}', [ContratosController::class, 'show'])->name('contratos.show')->middleware('can:contratos');
        Route::get('/contratos/{contrato}/edit', [ContratosController::class, 'edit'])->name('contratos.edit')->middleware('can:contratos');
        Route::put('/contratos/{contrato}', [ContratosController::class, 'update'])->name('contratos.update')->middleware('can:contratos');
        Route::delete('/contratos/{contrato}', [ContratosController::class, 'destroy'])->name('contratos.destroy')->middleware('can:contratos');


        Route::post('/upload-documento', [DocumentosContratosController::class, 'uploadDocumento'])->name('upload.documento')->middleware('can:contratos');


        //Rotas Fontes Pagadoras
        Route::get('/fontespagadoras', [FontesPagadorasController::class, 'index'])->name('fontespagadoras.index')->middleware('can:admin');
        Route::get('/fontespagadoras/create', [FontesPagadorasController::class, 'create'])->name('fontespagadoras.create')->middleware('can:admin');
        Route::post('/fontespagadoras', [FontesPagadorasController::class, 'store'])->name('fontespagadoras.store')->middleware('can:admin');
        Route::get('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'show'])->name('fontespagadoras.show')->middleware('can:admin');
        Route::get('/fontespagadoras/{fontepagadora}/edit', [FontesPagadorasController::class, 'edit'])->name('fontespagadoras.edit')->middleware('can:admin');
        Route::put('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'update'])->name('fontespagadoras.update')->middleware('can:admin');
        Route::delete('/fontespagadoras/{fontepagadora}', [FontesPagadorasController::class, 'destroy'])->name('fontespagadoras.destroy')->middleware('can:admin');


        //Rotas Veiculos
        Route::get('/veiculos', [VeiculosController::class, 'index'])->name('veiculos.index')->middleware('can:veiculos');
        Route::get('/veiculos/create', [VeiculosController::class, 'create'])->name('veiculos.create')->middleware('can:veiculos');
        Route::post('/veiculos', [VeiculosController::class, 'store'])->name('veiculos.store')->middleware('can:veiculos');
        Route::get('/veiculos/{veiculo}', [VeiculosController::class, 'show'])->name('veiculos.show')->middleware('can:veiculos');
        Route::get('/veiculos/{veiculo}/edit', [VeiculosController::class, 'edit'])->name('veiculos.edit')->middleware('can:veiculos');
        Route::put('/veiculos/{veiculo}', [VeiculosController::class, 'update'])->name('veiculos.update')->middleware('can:veiculos');
        Route::delete('/veiculos/{veiculo}', [VeiculosController::class, 'destroy'])->name('veiculos.destroy')->middleware('can:veiculos');

        //Rotas Contas a Pagar
        Route::get('/contasapagar', [ContasAPagarController::class, 'index'])->name('contasapagar.index')->middleware('can:contasapagar');
        Route::get('/contasapagar/create', [ContasAPagarController::class, 'create'])->name('contasapagar.create')->middleware('can:contasapagar');
        Route::post('/contasapagar', [ContasAPagarController::class, 'store'])->name('contasapagar.store')->middleware('can:contasapagar');
        Route::get('/contasapagar/{conta}', [ContasAPagarController::class, 'show'])->name('contasapagar.show')->middleware('can:contasapagar');
        Route::get('/contasapagar/{conta}/edit', [ContasAPagarController::class, 'edit'])->name('contasapagar.edit')->middleware('can:contasapagar');
        Route::put('/contasapagar/{conta}', [ContasAPagarController::class, 'update'])->name('contasapagar.update')->middleware('can:contasapagar');
        Route::delete('/contasapagar/{conta}', [ContasAPagarController::class, 'destroy'])->name('contasapagar.destroy')->middleware('can:contasapagar');
        Route::post('/contasapagar/{conta}/mudarstatus', [ContasAPagarController::class, 'mudarStatus'])->name('contasapagar.mudarstatus')->middleware('can:pagarcontas');
        Route::get('/exibirrelatoriocontasapagar', [ContasAPagarController::class, 'exibirRelatorioContasAPagar'])->name('contasapagar.exibirrelatorio')->middleware('can:admin');
        Route::get('/relatorioscontasapagar', [ContasAPagarController::class, 'relatoriosContasAPagar'])->name('contasapagar.relatorios')->middleware('can:admin');



    //Rotas Notas Fiscais
        Route::get('/notasfiscais', [NotasFiscaisController::class, 'index'])->name('notasfiscais.index')->middleware('can:notasfiscais');
        Route::get('/notasfiscais/create', [NotasFiscaisController::class, 'create'])->name('notasfiscais.create')->middleware('can:notasfiscais');
        Route::post('/notasfiscais', [NotasFiscaisController::class, 'store'])->name('notasfiscais.store')->middleware('can:notasfiscais');
        Route::get('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'show'])->name('notasfiscais.show')->middleware('can:notasfiscais');
        Route::get('/notasfiscais/{notafiscal}/edit', [NotasFiscaisController::class, 'edit'])->name('notasfiscais.edit')->middleware('can:admin');
        Route::put('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'update'])->name('notasfiscais.update')->middleware('can:admin');
        Route::delete('/notasfiscais/{notafiscal}', [NotasFiscaisController::class, 'destroy'])->name('notasfiscais.destroy')->middleware('can:admin');

        Route::post('/upload-notafiscal', [NotasFiscaisController::class, 'uploadNota2'])->name('upload.notafiscal')->middleware('can:notasfiscais');
        Route::post('/status-notafiscal/{notafiscal}', [NotasFiscaisController::class, 'statusNota'])->name('status.notafiscal')->middleware('can:notasfiscais');

        //Rotas Ordem de Servico
        Route::get('/ordensservico', [OrdemServicoController::class,'index'])->name('ordensservicos.index')->middleware('can:ordemservico');
        Route::get('/ordensservico/create', [OrdemServicoController::class,'create'])->name('ordensservicos.create')->middleware('can:ordemservico');
        Route::post('/ordensservico', [OrdemServicoController::class,'store'])->name('ordensservicos.store')->middleware('can:ordemservico');
        Route::get('/ordensservico/{ordemServico}', [OrdemServicoController::class,'show'])->name('ordensservicos.show')->middleware('can:ordemservico');
        Route::get('/ordensservico/{ordemServico}/edit', [OrdemServicoController::class,'edit'])->name('ordensservicos.edit')->middleware('can:ordemservico');
        Route::put('/ordensservico/{ordemServico}', [OrdemServicoController::class,'update'])->name('ordensservicos.update')->middleware('can:ordemservico');
        Route::delete('/ordensservico/{ordemServico}', [OrdemServicoController::class,'destroy'])->name('ordensservicos.destroy')->middleware('can:ordemservico');


        //Rotas FluxoCaixa
        Route::get('/fluxocaixa', [FluxoCaixasController::class, 'index'])->name('fluxocaixas.index')->middleware('can:fluxocaixacadastro');
        Route::get('/fluxocaixa/create', [FluxoCaixasController::class,'create'])->name('fluxocaixas.create')->middleware('can:fluxocaixacadastro');
        Route::post('/fluxocaixa', [FluxoCaixasController::class,'store'])->name('fluxocaixas.store')->middleware('can:fluxocaixacadastro');
        Route::get('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'show'])->name('fluxocaixas.show')->middleware('can:fluxocaixacadastro');
        Route::get('/fluxocaixa/{fluxoCaixa}/edit', [FluxoCaixasController::class,'edit'])->name('fluxocaixas.edit')->middleware('can:fluxocaixa');
        Route::put('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'update'])->name('fluxocaixas.update')->middleware('can:fluxocaixa');
        Route::delete('/fluxocaixa/{fluxoCaixa}', [FluxoCaixasController::class,'destroy'])->name('fluxocaixas.destroy')->middleware('can:admin');

        Route::get('/get-ordem-servico-por-contrato', [FluxoCaixasController::class,'getOrdemServicoPorContrato']);
        Route::get('/exibirrelatorio', [FluxoCaixasController::class,'exibirRelatorio'])->name('fluxocaixas.exibirrelatorio')->middleware('can:admin');
        Route::get('/relatorios', [FluxoCaixasController::class,'relatorios'])->name('fluxocaixas.relatorios')->middleware('can:admin');


        //Rotas Motoristas
        Route::get('/motoristas', [MotoristasController::class, 'index'])->name('motoristas.index')->middleware('can:motoristas');
        Route::get('/motoristas/create', [MotoristasController::class, 'create'])->name('motoristas.create')->middleware('can:motoristas');
        Route::post('/motoristas', [MotoristasController::class, 'store'])->name('motoristas.store')->middleware('can:motoristas');
        Route::get('/motoristas/{motorista}', [MotoristasController::class, 'show'])->name('motoristas.show')->middleware('can:motoristas');
        Route::get('/motoristas/{motorista}/edit', [MotoristasController::class, 'edit'])->name('motoristas.edit')->middleware('can:motoristas');
        Route::put('/motoristas/{motorista}', [MotoristasController::class, 'update'])->name('motoristas.update')->middleware('can:motoristas');
        Route::delete('/motoristas/{motorista}', [MotoristasController::class, 'destroy'])->name('motoristas.destroy')->middleware('can:motoristas');


        //Rotas Painel de Controlle
        Route::get('/painelcontrole', [PainelControleController::class, 'index'])->name('painelcontrole.index')->middleware('can:admin');
        Route::get('/painelcontrole/mensal', [PainelControleController::class, 'finMensal'])->name('painelcontrole.mensal')->middleware('can:admin');;
        Route::put('/painelcontrole/{contrato}', [PainelControleController::class, 'update'])->name('painelcontrole.update')->middleware('can:admin');;
        Route::get('/painelcontrole/graficos',function () {
            $controller = new NotasFiscaisController();
            $data = $controller->gerarGraficoFaturamentoPorMes();

            return view('painelcontrole.graficos', ['data' => $data]);
        })->name('painelcontrole.graficos')->middleware('can:admin');;



    // Rotas acessíveis por ambos, 'can:financeiro' e 'can:filipe'
    Route::get('/', function () {
        $controller = new NotasFiscaisController();
        $data = $controller->gerarGraficoFaturamentoPorMes();
        return view('example-app', ['data' => $data]);
    })->middleware('can:homepage');

});



