<?php

use Illuminate\Database\Seeder;
use App\Membre;
use App\Adresse;
use App\Emprunt;
use App\Article;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
      Eloquent::unguard();
        // $this->call(UsersTableSeeder::class);

        // call our class and run our seeds
        $this->call('AppSeeder');
        $this->command->info('app seeds finished.'); // show information in the command line after everything is run
    }
}

// our own seeder class
// usually this would be its own file
class AppSeeder extends Seeder {

    public function run() {

        // clear database ------------------------------------------
        DB::table('membres')->delete();
        DB::table('adresses')->delete();
        DB::table('emprunts')->delete();
        DB::table('articles')->delete();


        // seed table Adresses ------------------------


      $adresse1 = Adresse::create(array(
            'noCivic'  => '4840',
            'app' => '4',
            'rue' => 'st-laurent',
            'codePostal' => 'h1f5p8',
            'ville' => 'montreal',
            'province'=> 'Qc'
        ));
        $adresse2 = Adresse::create(array(
          'noCivic'  => '7130',
          'app' => '8',
          'rue' => 'cannes',
          'codePostal' => 'f6n5l9',
          'ville' => 'montreal',
          'province'=> 'Qc'
        ));
      $adresse3 = Adresse::create(array(
          'noCivic'  => '6090',
          'app' => '2',
          'rue' => 'faubourd',
          'codePostal' => 'g6g8f6',
          'ville' => 'Laval',
          'province'=> 'Qc'
        ));

        $this->command->info('Adresses ajoutées');

        // seed Membres table -----------------------

        $membreLawly = Membre::create(array(
            'nom'      => 'Lawly',
            'prenom'   => 'black',
            'id_adresse'  => $adresse1->id,
            'courriel' => 'lawly@hotmail.com',
            'password' => '1234',
            'photo'    => 'url1'
        ));

        $membreCerms = Membre::create(array(
          'nom'      => 'Cerms',
          'prenom'   => 'brown',
          'id_adresse'  => $adresse2->id,
          'courriel' => 'cerms@hotmail.com',
          'password' => '5678',
          'photo'    => 'url2'
        ));

        $membreAdobot = Membre::create(array(
          'nom'      => 'Adobot',
          'prenom'   => 'white',
          'id_adresse'  => $adresse3->id,
          'courriel' => 'adobot@hotmail.com',
          'password' => '9101112',
          'photo'    => 'url3'
        ));

        $this->command->info('Membres ajoutés');

        // seed Article table ---------------------

    $article1 = Article::create(array(
        'nom' => 'marteau',
        'description' => 'un marteau en bon état',
        'categorie' => 'outils',
        'id_proprietaire' => $membreAdobot->id
      ));

    $article2 = Article::create(array(
        'nom' => 'scie',
        'description' => 'une scie neuve',
        'categorie' => 'outils',
        'id_proprietaire' => $membreCerms->id
      ));

      $this->command->info('Articles ajoutés');


      // seed Emprunts table ---------------------
              Emprunt::create(array(
                  'dateEmprunt'    => '2017-09-20',
                  'dateRetour'     => '2017-09-30',
                  'id_emprunteur' => $membreLawly->id,
                  'id_article' => $article1->id
              ));

              Emprunt::create(array(
                'dateEmprunt'    => '2017-09-10',
                'dateRetour'     => '2017-09-15',
                'id_emprunteur' => $membreLawly->id,
                'id_article' => $article2->id
              ));

              $this->command->info('Emprunts ajoutés');

    }



}
