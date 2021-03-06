<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
  protected $fillable = ['dateEmprunt', 'dateRetour', 'id_emprunteur', 'id_article'];

  public function membres() {
    return $this->belongsTo('App\Membre', 'id_emprunteur');
  }

  public function articles() {
    return $this->belongsTo('App\Article', 'id_article');
  }

  public $timestamps = false;

}
