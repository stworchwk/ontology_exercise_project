<?php
header('Content-Type: application/json');

if ($_GET['function'] == 'getExercise') {
    getExercise($_GET['disease'], $_GET['age'], $_GET['gender'], $_GET['timePerDay']);
}

function getExercise($disease, $age, $gender, $timePerDay)
{
    /* ARC2 static class inclusion */
    include_once('vendor/semsol/arc2/ARC2.php');

    $dbpconfig = array(
        "remote_store_endpoint" => "http://localhost:3030/diet_project/query",
    );

    $exercise = 'PREFIX diet_project: <http://www.semanticweb.org/diet_project#>
SELECT ?exercise_name '. ($gender == 'male' ? '?exercise_kcal_burn_per_minute_male' : 'exercise_kcal_burn_per_minute_female') . ' (COUNT(?exercise_disease_avoid) AS ?exercise_disease_avoids)
WHERE {
  ?exercise diet_project:exercise_name ?exercise_name.
  ?exercise diet_project:exercise_minimum_age ?exercise_minimum_age .
  ?exercise diet_project:exercise_maximum_age ?exercise_maximum_age .
  ?exercise diet_project:exercise_minimum_time ?exercise_minimum_time .
  ?exercise diet_project:exercise_maximum_time ?exercise_maximum_time .
  '.
        ($gender == 'male' ? '?exercise diet_project:exercise_kcal_burn_per_minute_male ?exercise_kcal_burn_per_minute_male .' : '?exercise diet_project:exercise_kcal_burn_per_minute_female ?exercise_kcal_burn_per_minute_female .')
    .'
  OPTIONAL {
     ?exercise diet_project:exercise_disease_avoid ?exercise_disease_avoid.
        FILTER (?exercise_disease_avoid != "' . ($disease == 'null' ? '' : $disease) . '")
  }
  FILTER (?exercise_minimum_age <= ' . $age . ' && ?exercise_maximum_age >= ' . $age . ') .
  FILTER (?exercise_minimum_time <= ' . $timePerDay . ') .
}
GROUP BY ?exercise_name '. ($gender == 'male' ? '?exercise_kcal_burn_per_minute_male' : 'exercise_kcal_burn_per_minute_female');

    echo json_encode(ARC2::getRemoteStore($dbpconfig)->query($exercise, 'rows'));
}