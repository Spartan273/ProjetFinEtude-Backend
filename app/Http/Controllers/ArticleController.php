<?php
namespace App\Http\Controllers;

use App\Membre;
use App\Adresse;
use App\Article;
use App\Emprunt;
use Illuminate\Http\Request;
use JWTAuth;

class ArticleController extends Controller {


  public function postArticle(Request $request) {

    //recupère le membre à partir du token
    $membre = JWTAuth::parseToken()->toUser();

    $article = new Article();
    $article->nom = $request->input('nom');
    $article->description = $request->input('description');
    $article->categorie = $request->input('categorie');
    $article->id_proprietaire = $membre->id;
    $article->save();

    return response()->json(['article' => $article]);

  }

  public function getArticles(Request $request) {

    $articles = Article::with('membres')->get();

    return response()->json(['articles' => $articles], 200);
  }

  public function getArticle(Request $request, $id) {

    $article = Article::with('membres')->find($id);
    if(!$article){
      return response()->json(['message' => 'Article introuvable'], 404);
    }

    return response()->json(['article' => $article]);
  }

  public function putArticle(Request $request, $id) {
    $article = Article::find($id);
    if(!$article){
      return response()->json(['message' => 'Document not found'], 404);
    }

    $article->nom = $request->input('nom');
    $article->description = $request->input('description');
    $article->categorie = $request->input('categorie');
    $article->id_proprietaire = $request->input('id_proprietaire');
    $article->save();

    return response()->json(['article' => $article], 200);

  }

  public function deleteArticle($id) {

    $article = Article::find($id);
    if(!$article){
      return response()->json(['message' => 'impossible de supprimer'], 404);
    }
    $article->delete();

    return response()->json(['message' => 'article supprimé'], 200);


  }




}
