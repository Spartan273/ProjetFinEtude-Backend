<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Adresse;

class Membre extends Authenticatable
{
    use Notifiable;


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nom', 'prenom', 'courriel', 'password', 'photo'
    ];

    //Relations
    public function adresses() {
      return $this->belongsTo('App\Adresse', 'id_adresse');
    }

    public function articles() {
      return $this->hasMany('Article');
    }

    public function emprunts() {
      return $this->hasMany('Emprunt');
    }



    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public $timestamps = false;
}
