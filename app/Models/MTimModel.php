<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MTimModel extends Model
{

    protected $table = "m_tim_models";
        protected $guarded =[
           'id',
           'updated_at',
           'created_at',

        ];



}
