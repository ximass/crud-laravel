<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class PessoasModel extends Model 
{
    use HasFactory, Searchable;
    
    protected $table = 'pessoas';
    
    protected $fillable = [
        'nome',
        'cpf',
        'sexo',
        'email',
        'fone',
        'data_nascimento'
    ];

    public function toSearchableArray()
    {
        return [
            'nome' => $this->nome,
            'email' => $this->email,
            'sexo' => $this->sexo,
            'fone' => $this->fone
        ];
    }
}
