<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Quote extends Model
{
  	/*protected $connection = 'mongodb';
    protected $collection = 'quotes';
    */

    protected $fillable = ['content'];
}
