<html>
<body>

<?php
/* ARC2 static class inclusion */
include_once('vendor/semsol/arc2/ARC2.php');

$dbpconfig = array(
    "remote_store_endpoint" => "http://localhost:3030/exercise_project/sparql",
);

$store = ARC2::getRemoteStore($dbpconfig);

if ($errs = $store->getErrors()) {
    echo "<h1>getRemoteSotre error<h1>";
}

$query = '
  PREFIX rdfs: <http://www.w3.org/2000/01/rdf-schema#>

  SELECT ?subject ?predicate ?object
WHERE {
  ?subject ?predicate ?object
}
LIMIT 25';

/* execute the query */
$rows = $store->query($query, 'rows');
print_r($rows);
//if ($errs = $store->getErrors()) {
//    echo "Query errors";
//    print_r($errs);
//}
?>
</body>
</html>