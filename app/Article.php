<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


class Article extends Model
{
  protected $fillable = ['nom', 'description', 'categorie', 'id_proprietaire'];

  public function membre() {
    return $this->belongsTo('Membre');
  }

  public $timestamps = false;

}
