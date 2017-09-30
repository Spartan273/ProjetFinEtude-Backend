<?php
namespace App\Http\Controllers;

use App\Membre;
use App\Adresse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use JWTAuth;

class MembreController extends Controller {


  public function postMembre(Request $request) {

    $adresse = new Adresse;
    $adresse->noCivic = $request->input('noCivic');
    $adresse->app = $request->input('app');
    $adresse->rue = $request->input('rue');
    $adresse->codePostal = $request->input('codePostal');
    $adresse->ville = $request->input('ville');
    $adresse->province = $request->input('province');

    $adresse->save();

    $membre = new Membre;
    $membre->nom = $request->input('nom');
    $membre->prenom = $request->input('prenom');
    $membre->id_adresse = $adresse->id;
    $membre->courriel = $request->input('courriel');
    $membre->password = $request->input('password');
    $membre->photo = $request->input('photo');

    $membre->save();

    return response()->json(['membre'=> $membre, 'adresse'=> $adresse], 201);

  }

  public function getMembres() {
   $membres = Membre::with('adresses')->get();
    $response = [
      'membres' => $membres
    ];
    return response()->json($response,200);
  }

  public function putMembre(Request $request, $id) {

    $membre = Membre::find($id);
    if(!$membre){
      return response()->json(['message' => 'Document not found'], 404);
    }

    $adresse = Adresse::find($membre->id_adresse);

    $adresse->noCivic = $request->input('noCivic');
    $adresse->app = $request->input('app');
    $adresse->rue = $request->input('rue');
    $adresse->codePostal = $request->input('codePostal');
    $adresse->ville = $request->input('ville');
    $adresse->province = $request->input('province');
    $adresse->save();

    $membre->nom = $request->input('nom');
    $membre->prenom = $request->input('prenom');
    $membre->id_adresse = $adresse->id;
    $membre->courriel = $request->input('courriel');
    $membre->password = bcrypt($request->input('password'));
    $membre->photo = $request->input('photo');
    $membre->save();

    return response()->json(['membre'=> $membre, 'adresse' => $adresse], 200);

  }

  public function getMembre($id) {
  $membre = Membre::with('adresses')->find($id);

    $response = [
      'membre' => $membre
    ];
    return response()->json($response,200);
  }

  public function deleteMembre($id) {

    $membre = Membre::find($id);
    $adresse = Adresse::find($membre->id_adresse);
    $membre->delete();
    $adresse->delete();
    return response()->json(['message' => 'utilisateur supprimé'], 200);
  }


  //Inscription d'un utilisateur
  public function signup(Request $request) {

    $this->validate($request, [
      'nom' => 'required',
      'prenom' => 'required',
      'courriel' => 'required|email|unique:membres',
      'password' => 'required',
      'noCivic' => 'required',
      'rue' => 'required',
      'codePostal' => 'required',
      'ville' => 'required',
      'province' => 'required'
    ]);

    $adresse = new Adresse;
    $adresse->noCivic = $request->input('noCivic');
    $adresse->app = $request->input('app');
    $adresse->rue = $request->input('rue');
    $adresse->codePostal = $request->input('codePostal');
    $adresse->ville = $request->input('ville');
    $adresse->province = $request->input('province');

    $adresse->save();

    $membre = new Membre;
    $membre->nom = $request->input('nom');
    $membre->prenom = $request->input('prenom');
    $membre->id_adresse = $adresse->id;
    $membre->courriel = $request->input('courriel');
    $membre->password = bcrypt($request->input('password'));
    $membre->photo = $request->input('photo');

    $membre->save();

    return response()->json(['message' => 'nouveau membre créé'], 201);

  }

  //Authentification de l'utilisateur avec jwt-auth
  public function signin(Request $request) {

    $this->validate($request, [
      'courriel' => 'required|email',
      'password' => 'required'
    ]);

    $credentials = $request->only('courriel', 'password');

    try {
      if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Identifiants non valides'], 401);
      }
    } catch (JWTException $e) {
      return response()->json(['creation du token impossible'], 500);
    }

    //si l'authentification est réussie, envoi du token
    return response()->json(['token' => $token]);

  }



}
