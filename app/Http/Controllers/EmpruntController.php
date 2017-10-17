<?php
namespace App\Http\Controllers;

use App\Membre;
use App\Adresse;
use App\Article;
use App\Emprunt;
use Illuminate\Http\Request;
use JWTAuth;


class EmpruntController extends Controller {

    public function postEmprunt(Request $request) {

      $membre = JWTAuth::parseToken()->toUser();


      $emprunt = new Emprunt();
      $emprunt->dateEmprunt = $request->input('dateEmprunt');
      $emprunt->dateRetour = $request->input('dateRetour');
      $emprunt->id_article = $membre->id;
    //  $emprunt->id_emprunteur = $request->input('id_emprunteur');
    $emprunt->id_emprunteur = $membre->id;
      $emprunt->id_article = $request->input('id_article');
      $emprunt->save();

      return response()->json(['emprunt' => $emprunt]);

    }

    public function getEmprunts() {
      $emprunts = Emprunt::with('membres')->get();
      return response()->json(['emprunts' => $emprunts], 200);

    }

    public function getEmprunt($id) {
    /*  $emprunt = Emprunt::with('membres')->find($id);
      if(!$emprunt){
        return response()->json(['message' => 'document introuvable'], 404);
      }

      return response()->json(['emprunt' => $emprunt], 200);*/

      $emprunt = Emprunt::with('membres')->where('id_emprunteur', $id)->with('articles')->get();
  //  $emprunt = Emprunt::where('id_emprunteur', $id)->get();
        if(!$emprunt){
          return response()->json(['message' => 'document introuvable'], 404);
        }

        return response()->json(['emprunt' => $emprunt], 200);


    }

    public function putEmprunt(Request $request, $id) {
      $emprunt = Emprunt::find($id);
      if(!$emprunt){
        return response()->json(['message' => 'Document not found'], 404);
      }

      $emprunt->dateEmprunt = $request->input('dateEmprunt');
      $emprunt->dateRetour = $request->input('dateRetour');
      $emprunt->id_emprunteur = $request->input('id_emprunteur');
      $emprunt->id_article = $request->input('id_article');
      $emprunt->save();

      return response()->json(['emprunt' => $emprunt], 200);
    }

    public function deleteEmprunt($id) {
      $emprunt = Emprunt::find($id);
      $emprunt->delete();

      return response()->json(['message' => 'emprunt supprimé']);
    }
}
