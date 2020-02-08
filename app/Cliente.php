<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    protected $table = 'clientes';
    protected $fillable = [
        'razao_social', 'nome_fantasia', 'cnpj', 'endereco', 'email', 
        'telefone', 'nome_responsavel', 'cpf', 'celular'
    ];

    public function propostas() {
        return $this->hasMany('App\Proposta');
    }
}
