<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChatZalo extends Model
{
    
    //
     /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'chatzalo';

    /**
     * The database primary key value.
     *
     * @var string
     */
    protected $primaryKey = 'id';
}
