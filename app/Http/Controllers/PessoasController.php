<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PessoasModel;

class PessoasController extends Controller
{
    private $pessoa;

    public function __construct()
    {
        $this->pessoa = new PessoasModel();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $pessoa = $this->pessoa->all()->sortBy('nome');

        if($request->filled('search')){
            $pessoa = PessoasModel::search($request->search)->get();
        }

        return view('index', compact('pessoa'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->pessoa->create([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'sexo' => $request->sexo,
            'email' => $request->email,
            'fone' => $request->fone,
            'data_nascimento' => $request->data_nascimento
        ]);

        return redirect('/');
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
        $this->pessoa->where(['id' => $id])->update([
            'nome' => $request->nome,
            'cpf' => $request->cpf,
            'sexo' => $request->sexo,
            'email' => $request->email,
            'fone' => $request->fone,
            'data_nascimento' => $request->data_nascimento
        ]);

        return redirect('/');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $comando = $this->pessoa->destroy($id);

        return ($comando) ? 'sucesso' : 'erro';
    }
}
