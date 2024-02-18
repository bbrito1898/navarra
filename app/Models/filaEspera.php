<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class filaEspera extends Model
{
    use HasFactory;
    protected $table='lista_de_espera';
    protected $filable=['cesto','pais','quantidade','condicao_pagamento'];
}
