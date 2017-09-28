<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Emprunt extends Model
{
  protected $fillable = ['dateEmprunt', 'dateRetour', 'id_emprunteur', 'id_article'];

  public function membre() {
    return $this->belongsTo('Membre');
  }

  public $timestamps = false;

}
