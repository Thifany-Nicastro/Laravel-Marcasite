<?php

namespace App\Http\Controllers;

use App\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $clientes = Cliente::paginate(7);
        //$query = DB::table('clientes')->where('user_id', '1')->get();
        /*$id = Auth::user()->id;
        $clientes = Cliente::where('user_id', $id)->paginate(7);*/
        return view('clientes.index', compact('clientes'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('clientes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cnpj' => 'required',
            'endereco' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'nome_responsavel' => 'required',
            'cpf' => 'required',
            'celular' => 'required',
        ]);
        
        $clienteData = $request->all();
        $clienteData['user_id'] = Auth::user()->id;

        Cliente::create($clienteData);//$request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente cadastrado com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $propostas = Cliente::find($id)->propostas;

        $cliente = Cliente::findOrFail($id);
        return view('clientes.show', compact('cliente', 'propostas'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cliente = Cliente::findOrFail($id);
        return view('clientes.edit', compact('cliente'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'razao_social' => 'required',
            'nome_fantasia' => 'required',
            'cnpj' => 'required',
            'endereco' => 'required',
            'email' => 'required',
            'telefone' => 'required',
            'nome_responsavel' => 'required',
            'cpf' => 'required',
            'celular' => 'required',
        ]);
        Cliente::find($id)->update($request->all());
        return redirect()->route('clientes.index')->with('success', 'Cliente atualizado com sucesso');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Cliente::find($id)->delete();
        return redirect()->route('clientes.index')->with('success', 'Cliente deletado com sucesso');
    }
}
