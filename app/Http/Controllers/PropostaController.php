<?php

namespace App\Http\Controllers;

use App\Cliente;
use App\Exports\PropostasExport;
use App\Proposta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class PropostaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $id = Auth::user()->id;
        $propostas = Proposta::where('user_id', $id)->paginate(7);
        //$propostas = Proposta::paginate(7);
        return view('propostas.index', compact('propostas'))->with('i', (request()->input('page', 1) - 1) * 5);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $clientes = Cliente::all();
        return view('propostas.create', compact('clientes'));
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
            'cliente_id' => 'required',
            'endereco' => 'required',
            'valor_total' => 'required',
            'valor_sinal' => 'required',
            'qtde_parcelas' => 'required',
            'valor_parcelas' => 'required',
            'data_pagamento' => 'required',
            'data_parcelas' => 'required',
            'arquivo' => 'required',
            'status' => 'required',
        ]);

        $propostaData = $request->all();
        $propostaData['user_id'] = Auth::user()->id;

        Proposta::create($propostaData);

        //Proposta::create($request->all());
        return redirect()->route('propostas.index')->with('success', 'Proposta cadastrada com sucesso');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $proposta = Proposta::findOrFail($id);
        if (!Auth::user()->can('view', $proposta)) {
            abort(403, trans('Desculpe, você não tem permissão :('));
        } else {
            return view('propostas.show', compact('proposta'));
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $proposta = Proposta::findOrFail($id);
        if (!Auth::user()->can('view', $proposta)) {
            abort(403, trans('Desculpe, você não tem permissão :('));
        } else {
            return view('propostas.edit', compact('proposta'));
        }
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
        $proposta = Proposta::findOrFail($id);
        if (!Auth::user()->can('view', $proposta)) {
            abort(403, trans('Desculpe, você não tem permissão :('));
        } else {
            request()->validate([
                'endereco' => 'required',
                'valor_total' => 'required',
                'valor_sinal' => 'required',
                'qtde_parcelas' => 'required',
                'valor_parcelas' => 'required',
                'data_pagamento' => 'required',
                'data_parcelas' => 'required',
                'arquivo' => 'required',
                'status' => 'required',
            ]);
            $proposta->update($request->all());
            return redirect()->route('propostas.index')->with('success', 'Proposta atualizada com sucesso');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $proposta = Proposta::findOrFail($id);
        if (!Auth::user()->can('view', $proposta)) {
            abort(403, trans('Desculpe, você não tem permissão :('));
        } else {
            $proposta->delete();
            return redirect()->route('propostas.index')->with('success', 'Proposta deletada com sucesso');
        }
    }

    public function search(Request $request)
    {
        $search_cliente = $request->get('search-cliente');
        $search_status = $request->get('search-status');
        $search_mes = $request->search_mes;

        if ($search_mes != 0) {
            $propostas = Proposta::with('cliente')
                ->where('cliente_id', 'like', '%' . $search_cliente . '%')
                ->where('status', 'like', '%' . $search_status . '%')
                ->whereMonth('created_at', $search_mes)
                ->where('user_id', '=', Auth::user()->id)
                ->paginate(7);
        } else {
            $propostas = Proposta::with('cliente')
                ->where('cliente_id', 'like', '%' . $search_cliente . '%')
                ->where('status', 'like', '%' . $search_status . '%')
                ->where('user_id', '=', Auth::user()->id)
                ->paginate(7);
        }

        return view('propostas.index', ['propostas' => $propostas]);
    }

    public function export()
    {
        return Excel::download(new PropostasExport, 'propostas.xlsx');
    }
}
