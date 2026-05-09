<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Curso extends Model
{
    // Isso autoriza o Laravel a salvar esses dados no banco
    protected $fillable = [
        'titulo', 'descricao', 'valor', 'imagem', 'publicado'
    ];
}