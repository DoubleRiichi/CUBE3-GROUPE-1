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

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
