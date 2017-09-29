<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membre;

class Article extends Model
{
  protected $fillable = ['nom', 'description', 'categorie', 'id_proprietaire'];

  public function membres() {
    return $this->belongsTo('App\Membre', 'id_proprietaire');
  }


  public $timestamps = false;

}
