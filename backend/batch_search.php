<?php header('Content-Type:
application/json');

$host = 'localhost';
77/166

$db = 'mmdb';
$user = 'root';
$pass = '';
$conn = new mysqli($host, $user, $pass, $db); if
($conn->connect_error) {

echo

json_encode([]);
exit;
}

if ($_FILES['csv']['error'] !== UPLOAD_ERR_OK) {

echo

json_encode([]);
exit;
}

$csvData = array_map('str_getcsv', file($_FILES['csv']['tmp_name']));
$metabolites = array_map('trim', array_column($csvData, 0));

$tables = ['sorghum', 'finger'];
$results = [];

foreach ($metabolites as $metaboliteName) {
$found = false;

foreach

($tables as $table) {
$stmt = $conn->prepare("SELECT `METABOLITES`, `PUBCHEM ID`, `SMILES`,
`ACTIVITY(EXPERIMENTAL)`, `ACTIVITY(PREDICTED)`, `REFERENCES` FROM `$table` WHERE
`METABOLITES` = ?");
$stmt->bind_param("s", $metaboliteName);
$stmt->execute();

78/166

$res = $stmt->get_result();

if ($row = $res->fetch_assoc()) {
$results[] = $row;
$found = true;

break;

}
$stmt->close();
}

if (!$found) {
$results[] = [
"METABOLITES" => $metaboliteName,
"PUBCHEM ID" => "Not Found",
"SMILES" => "Not Found",
"ACTIVITY(EXPERIMENTAL)" => "Not Found",
"ACTIVITY(PREDICTED)" => "Not Found",
"REFERENCES" => "Not Found"
];
}
}

$conn->close(); echo
json_encode($results);
?>

