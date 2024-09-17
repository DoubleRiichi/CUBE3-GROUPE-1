<?php
/*All of the exported files are available for download from http://files.tmdb.org. 
  The export job runs every day starting at around 7:00 AM UTC, and all files are available by 8:00 AM UTC.
  exemple: http://files.tmdb.org/p/exports/movie_ids_XX_XX_XXXX.json.gz */

$TODAY = getdate();

//CONFIG -------------
$ExecuteDay = "Sunday";
$ExecuteHour = "21";
$ExecuteMinute = "00";
//--------------------

if($TODAY["weekday"] == $ExecuteDay && $TODAY["hours"] >= $ExecuteHour && $TODAY["minutes"] > $ExecuteMinute) {
    $day = $TODAY["mday"];
    $month = $TODAY["mon"];
    $year = $TODAY["year"];

    if($day < 10)
        $day = "0" . $day;
    if($month < 10)
        $month = "0" . $month;

    $export_link = "http://files.tmdb.org/p/exports/movie_ids_$month" . "_" . $day . "_" . "$year.json.gz";
    echo $export_link;

    $export_json = file_get_contents($export_link);
    file_put_contents("./latest.json.gz", $export_json);
}