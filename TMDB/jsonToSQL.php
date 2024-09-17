<?php error_reporting(0);
/* Utilise les exports quotidients de TMDB pour récupérer les détails de chaque films, et traduit les valeurs qui nous intéresse en INSERT SQL.
 * for images: https://image.tmdb.org/t/p/original/[poster_path]
 */

echo "running...";

$TABLENAME = "movies";
$COLUMNS = ["budget", "id", "original_title", "imdb_id", "overview", "release_date", "poster_path", "original_language", "runtime", "status", "title", "popularity", "tagline", "homepage", ];
$API_KEY = file_get_contents("api_key");
$FAILED_IDs = [];


function fetchMovieDetails($key, $id): mixed {
  $contents = file_get_contents("http://api.themoviedb.org/3/movie/$id?api_key=$key&language=fr-FR");
  
  return json_decode($contents);
}

// Construct a valid SQL insert statment from a JSON object (without nesting)
function jsonToSQL(mixed $decoded_json, array $columns, string $tablename): string {

  $columns_str = "(";
  $values_str = "(";
  $id = "";

  foreach ($decoded_json as $key => $value) {
    if(in_array($key, $columns)) {
      $columns_str .= "`$key`, ";

      if(gettype($value) === "string") {
        $value = "\"$value\"";
      }

      if(strlen($value) < 1) { #line 190 causes issues, because "poster_path" in the json is set to null
        $value = '""';
      }

      $values_str  .= "$value, ";
    }

    if($key == "id") {
      $id = $value;
    }
  }

  $columns_str = substr($columns_str, 0, -2) . ")"; // removed the unecessary ", " and append a ")"
  $values_str = substr($values_str, 0, -2) . ")";

  //-- is a comment in SQL, we add the id at the end of the line so we can verify we got every id from the API down the line
  return "INSERT INTO `$tablename` $columns_str VALUES $values_str;--$id\n"; 
}


function recordContent($filename, $mode, $line) {
  $fp = fopen($filename, $mode);
  fwrite($fp, $line);
  fclose($fp);
}


$export_file = fopen("./export.json", "r") or die("Error opening the file!");
$sql_file = fopen("./movies.sql", "a");
$start_id = intval(file_get_contents("./LAST"));

if($start_id == null)
  $proceed = true;
else
  $proceed = false;

echo $start_id;

while(!feof($export_file)) { //While it's not the end of the file
  $line = fgets($export_file);
  $export_json = json_decode($line);
  $id = $export_json->id;

  if($proceed) {
    $movie_json = fetchMovieDetails($API_KEY, $id);
    
    if($movie_json === null) {
      if(!in_array($id, $FAILED_IDs)) {
        array_push($FAILED_IDs, $id);
        recordContent("./failures", "a", $id . "\n");
      }
    } else {
      $sql_statement = jsonToSQL($movie_json, $COLUMNS, $TABLENAME);
      fwrite($sql_file, $sql_statement);
      recordContent("./LAST", "w", $id); // so we know where we stopped at...
    }
  }

  if($start_id && $start_id === $id)
    $proceed = true;
}

fclose($export_file);
fclose($sql_file);
echo "done? (check LAST)";

/* RESULTAT DE TESTS:
   - 381 lignes de SQL par minute
   - 930518 lignes d'export / 381 ~= 40h pour tout récupérer.
*/