<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Membre;

class Adresse extends Model
{
  protected $fillable = ['noCivic', 'app', 'rue', 'codePostal', 'ville', 'province'];

  public function membres() {
    return $this->hasOne('App\Membre');
  }

  public $timestamps = false;
}
