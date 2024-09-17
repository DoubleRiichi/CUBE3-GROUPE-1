<p align="center"><img src="https://raw.githubusercontent.com/DoubleRiichi/MovieShelter/develop/public/Assets/logo_vertical.webp" width="400" alt="Movieshelter"></p>

# Introduction
MovieShelter est un site permettant la création de liste de films, il est possible de planifier ce que l'on souhaite visionner et de les noter. Il facilite la comparaison de goûts cinématographique, et encourage le débat en offrant un espace de discussion propre à chaque film présent dans notre base de données.  

Les imports proviennent de TMDB, dont l’API peut être scrappée par un script qui se charge de convertir le .json en expressions SQL prêtes à être insérées.  

Le projet utilise les technologies suivantes :  

### Frontend : 

- Langage : HTML5, JS, CSS3 
- Librairie : bootstrap 

### Backend :  
- Langage : PHP-8.3  
- Framework : Laravel  

### Server : 
- Apache avec Wamp 

### Base de données :  
- MariaDB/MySQL 

# Installation 
*Dépendance: PHP-8.3, Composer, MariaDB/MySQL/SQLite*
1. Cloner le répertoire [https://github.com/DoubleRiichi/MovieShelter.git](https://github.com/DoubleRiichi/MovieShelter.git)
2. ```console
   cd MovieShelter
   ```
   
4. ```console
   composer install
   ```
5. créer fichier .env, paramétrer sa BDD
   
7. ```console
   php artisan key:generate
   ```
8. ```console
   php artisan migrate:fresh
   ```
10. ```console
    php artisan db:seed
    ``` 
11. ```console
    php artisan storage:link
    ```
13. importer les données de /database/test_data/all_movies.sql dans la BDD de votre choix.


Par défaut deux comptes sont créés, un compte utilisateur et un compte administrateur. Pour s'y connecter:

**Admininistrateur**
- email: admin@admin.fr
- password: admin

**Utilisateur**
- email: user@user.fr
- password: user

## Scripts TMDB utilisation
Le projet utilise un script PHP pour récupérer les détails de films mis à disposition par l'API de TMDB. Des exports hebdomadaires sont générés par TMDB, ces exports contiennent un jeu de données sommaire pouvant servir de point de départ pour une utilisation de l'api plus poussée. Il n'est pas nécessaire de disposer d'une clé API pour les consulter. 

*Ligne d'un export hebdomadaire*
```json
    {"adult":false,"id":11,"original_title":"Star Wars","popularity":470.783,"video":false}
```
Ces exports peuvent être récupérés par le biais du script TMDB/fetchLastExport.php

C'est ensuite qu'intervient le script TMDB/jsonToSQL.php, il utilise un fichier export.json préalablement téléchargé pour connaître les IDs de films pouvant être obtenu en utilisant l'API. (en effet, les IDs ne sont pas simplement incrémentées 1 par 1.). Pour utiliser ce script et consulter l'API complète, il est nécessaire d'obtenir une clé API auprès de TMDB en formulant une demande sur leur forum de discussion. Cette clé doit être placée dans un fichier nommé "api_key" dans le même dossier que JsonToSQL.

Le script charge export.json et récupère l'id d'un film, exécute une requête pour cette ID, et traduit le json en SQL INSERT, avant de l'écrire dans un fichier. En cas d'erreur, l'id du film est enregistré dans un fichier "FAILURES" tandis que l'id du dernier film recupéré est traqué dans un fichier "LAST", en cas d'interruption du script.

*Réponse API pour un film*
```json
{
  "adult": false,
  "backdrop_path": "/jNjT5y95BToczcxgVPl1NBB7goY.jpg",
  "belongs_to_collection": {
    "id": 10,
    "name": "Star Wars - Saga",
    "poster_path": "/6mHkagjziBPth2Mx0VpEercocm4.jpg",
    "backdrop_path": "/zZDkgOmFMVYpGAkR9Tkxw0CRnxX.jpg"
  },
  "budget": 11000000,
  "genres": [
    {
      "id": 12,
      "name": "Aventure"
    },
    {
      "id": 28,
      "name": "Action"
    },
    {
      "id": 878,
      "name": "Science-Fiction"
    }
  ],
  "homepage": "",
  "id": 11,
  "imdb_id": "tt0076759",
  "origin_country": [
    "US"
  ],
  "original_language": "en",
  "original_title": "Star Wars",
  "overview": "Il y a bien longtemps, dans une galaxie très lointaine... La guerre civile fait rage entre l'Empire galactique et l'Alliance rebelle. Capturée par les troupes de choc de l'Empereur menées par le sombre et impitoyable Dark Vador, la princesse Leia Organa dissimule les plans de l’Étoile Noire, une station spatiale invulnérable, à son droïde R2-D2 avec pour mission de les remettre au Jedi Obi-Wan Kenobi. Accompagné de son fidèle compagnon, le droïde de protocole C-3PO, R2-D2 s'échoue sur la planète Tatooine et termine sa quête chez le jeune Luke Skywalker. Rêvant de devenir pilote mais confiné aux travaux de la ferme, ce dernier se lance à la recherche de ce mystérieux Obi-Wan Kenobi, devenu ermite au cœur des montagnes désertiques de Tatooine...",
  "popularity": 101.901,
  "poster_path": "/qelTNHrBSYjPvwdzsDBPVsqnNzc.jpg",
  "production_companies": [
    {
      "id": 1,
      "logo_path": "/tlVSws0RvvtPBwViUyOFAO0vcQS.png",
      "name": "Lucasfilm Ltd.",
      "origin_country": "US"
    },
    {
      "id": 25,
      "logo_path": "/qZCc1lty5FzX30aOCVRBLzaVmcp.png",
      "name": "20th Century Fox",
      "origin_country": "US"
    }
  ],
  "production_countries": [
    {
      "iso_3166_1": "US",
      "name": "United States of America"
    }
  ],
  "release_date": "1977-05-25",
  "revenue": 775398007,
  "runtime": 121,
  "spoken_languages": [
    {
      "english_name": "English",
      "iso_639_1": "en",
      "name": "English"
    }
  ],
  "status": "Released",
  "tagline": "Il y a bien longtemps dans une galaxie très lointaine…",
  "title": "La Guerre des étoiles",
  "video": false,
  "vote_average": 8.2,
  "vote_count": 20399
}
```
*traduction en SQL INSERT*
~~~ SQL
INSERT INTO `movies` (`budget`, `homepage`, `id`, `imdb_id`, `original_language`, `original_title`, `overview`, `popularity`, `poster_path`, `release_date`, `runtime`, `status`, `tagline`, `title`) VALUES (11000000, "", 11, "tt0076759", "en", "Star Wars", "Il y a bien longtemps, dans une galaxie très lointaine... La guerre civile fait rage entre l'Empire galactique et l'Alliance rebelle. Capturée par les troupes de choc de l'Empereur menées par le sombre et impitoyable Dark Vador, la princesse Leia Organa dissimule les plans de l’Étoile Noire, une station spatiale invulnérable, à son droïde R2-D2 avec pour mission de les remettre au Jedi Obi-Wan Kenobi. Accompagné de son fidèle compagnon, le droïde de protocole C-3PO, R2-D2 s'échoue sur la planète Tatooine et termine sa quête chez le jeune Luke Skywalker. Rêvant de devenir pilote mais confiné aux travaux de la ferme, ce dernier se lance à la recherche de ce mystérieux Obi-Wan Kenobi, devenu ermite au cœur des montagnes désertiques de Tatooine...", 101.901, "/qelTNHrBSYjPvwdzsDBPVsqnNzc.jpg", "1977-05-25", 121, "Released", "Il y a bien longtemps dans une galaxie très lointaine…", "La Guerre des étoiles");
~~~
## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
