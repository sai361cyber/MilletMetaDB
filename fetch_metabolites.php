<?php header('Content-Type:
application/json');

// Database connection parameters
$servername = "localhost";
$username = "root"; // Your database username
$password = "";

// Your database password (empty by default for XAMPP/WAMP root)

$dbname = "mmdb"; // Your database name

// Enable MySQLi error reporting for better debugging
mysqli_report(MYSQLI_REPORT_ERROR | MYSQLI_REPORT_STRICT);

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection if
($conn->connect_error) {
// Log the error and return JSON error message
failed: " . $conn->connect_error);

error_log("Database Connection

die(json_encode(["error" => "Database connection

failed. Please try again later."]));
}
// Get filter parameters from the URL
// These are expected to be in snake_case as per your millet_details.html update
$cultivar_name = $_GET['cultivar_name'] ?? '';
$geographical = $_GET['geographical'] ?? '';
$stress_type = $_GET['stress_type'] ?? '';
63/166

$conditions = $_GET['conditions'] ?? '';
$parts_of_plant = $_GET['parts_of_plant'] ?? '';
$method_infection = $_GET['method_infection'] ?? '';
$disease = $_GET['disease'] ?? '';
$causal_agent = $_GET['causal_agent'] ?? '';
$techniques_used_to_identify = $_GET['techniques_used_to_identify'] ?? '';
$millet_name_param = $_GET['millet'] ?? ''; // This is 'millet' from the details page, e.g.,
'sorghum'

// Get table name from URL, then validate and set default
$table_name = $_GET['table_name'] ?? '';
$valid_tables = [
'millet_1', 'millet_2', 'millet_3', 'millet_4', 'millet_5', 'millet_6', 'millet_7', 'millet_8',
'millet_9',
'sorghum_1', 'sorghum_2', 'sorghum_3', 'sorghum_4', 'sorghum_5', 'sorghum_6',
'sorghum_7', 'sorghum_8', 'sorghum_9',
'pearl_1', 'pearl_2', 'pearl_3', 'pearl_4', 'pearl_5', 'pearl_6', 'pearl_7', 'pearl_8', 'pearl_9',
'maize_1', 'maize_2', 'maize_3', 'maize_4', 'maize_5', 'maize_6', 'maize_7', 'maize_8',
'maize_9',
'finger_1', 'finger_2', 'finger_3', 'finger_4', 'finger_5', 'finger_6', 'finger_7', 'finger_8',
'finger_9',
'major_minor', 'stress_all', 'disease_all'
];
// Ensure table name is valid, prevent SQL injection if (!in_array($table_name,
$valid_tables)) {

error_log("Invalid table name attempted: " . $table_name .

". Defaulting to sorghum_1.");
$table_name = 'sorghum_1'; // Defaulting to a safe table if an invalid table name is
provided
}

64/166

// Build WHERE clauses dynamically
$where_clauses = [];
$params = [];
$types = ""; // String for bind_param types (e.g., "sss")

// IMPORTANT: Ensure these column names EXACTLY match your database schema (case and
spaces).
// Use backticks (`) for column names that contain spaces or are MySQL reserved words.
// The conditions `!empty($var)` AND `!($var === 'NIL')` are crucial for filtering.

if (!empty($cultivar_name) && $cultivar_name !== 'NIL') {
$where_clauses[] = "`CULTIVAR NAME` LIKE ?";
$params[] = '%' . $cultivar_name . '%';
$types .= "s";
}
if (!empty($geographical) && $geographical !== 'NIL') {
$where_clauses[] = "GEOGRAPHICAL LIKE ?"; // Assuming no spaces in column name
$params[] = '%' . $geographical . '%';
$types .= "s";
}
if (!empty($stress_type) && $stress_type !== 'NIL') {
$where_clauses[] = "`STRESS TYPE` LIKE ?";
$params[] = '%' . $stress_type . '%';
$types .= "s";
}
if (!empty($conditions) && $conditions !== 'NIL') {
$where_clauses[] = "CONDITIONS LIKE ?"; // Assuming no spaces in column name
65/166

$params[] = '%' . $conditions . '%';
$types .= "s";
}
if (!empty($parts_of_plant) && $parts_of_plant !== 'NIL') {
$where_clauses[] = "`PARTS OF THE PLANT` LIKE ?";
$params[] = '%' . $parts_of_plant . '%';
$types .= "s";
}
if (!empty($method_infection) && $method_infection !== 'NIL') {
$where_clauses[] = "`METHOD USED FOR INFECTION` LIKE ?";
$params[] = '%' . $method_infection . '%';
$types .= "s";
}
if (!empty($disease) && $disease !== 'NIL') {
$where_clauses[] = "DISEASE LIKE ?"; // Assuming no spaces in column name
$params[] = '%' . $disease . '%';
$types .= "s";
}
if (!empty($causal_agent) && $causal_agent !== 'NIL') {
$where_clauses[] = "`CAUSAL AGENT` LIKE ?";
$params[] = '%' . $causal_agent . '%';
$types .= "s";
}
if (!empty($techniques_used_to_identify) && $techniques_used_to_identify !== 'NIL') {
$where_clauses[] = "`TECHNIQUES USED TO IDENTIFY` LIKE ?";
$params[] = '%' . $techniques_used_to_identify . '%';
$types .= "s";
}
66/166

// Add millet_name_param to filter if present (e.g., from first box)
// Only apply this filter if your tables actually have a 'MILLET NAME' column
// AND if the value in that column ('Sorghum', 'Pearl Millet', etc.) matches the parameter
passed.
if (!empty($millet_name_param) && $millet_name_param !== 'NIL') {
$where_clauses[] = "`MILLET NAME` LIKE ?";
$params[] = '%' . $millet_name_param . '%';
$types .= "s";
}

// Updated SELECT statement to include all requested columns with proper backticks //
Ensure these column names also EXACTLY match your database.
$sql = "SELECT
`MILLET NAME`,
`SCIENTIFIC NAME`,
`MAJOR/MINOR`,
`CULTIVAR NAME`,
GEOGRAPHICAL,
`STRESS TYPE`,
CONDITIONS,
`PARTS OF THE PLANT`,
`METHOD USED FOR INFECTION`,
DISEASE,
`CAUSAL AGENT`,
METABOLITES,
`PUBCHEM ID`,
67/166

SMILES,
`ACTIVITY(EXPERIMENTAL)`,
`ACTIVITY(PREDICTED)`,
`TECHNIQUES USED TO IDENTIFY`,
`REFERENCES`
FROM `" . $table_name . "`";

if (!empty($where_clauses)) {
$sql .= " WHERE " . implode(" AND ", $where_clauses);
}

$result_data = [];
try {

if

(!empty($params)) {
$stmt = $conn->prepare($sql);
if ($stmt === false) {
// Log prepare statement error with SQL and parameters

error_log("Failed to

prepare statement: " . $conn->error . " SQL: " . $sql . " Params:
" . print_r($params, true));

throw new Exception("Database error: Could

not prepare statement.");
}
// Bind parameters dynamically
$stmt->bind_param($types, ...$params);
$stmt->execute();
$result = $stmt->get_result();
} else {
// No parameters, execute direct query (still safe as table name is validated)

68/166

$result = $conn->query($sql);
if ($result === false) {
// Log direct query error with SQL
query: " . $conn->error . " SQL: " . $sql);

error_log("Failed to execute direct
throw new Exception("Database

error: Could not execute query.");
}
}

// Check if any rows were returned
($result->num_rows > 0) {

if

while ($row

= $result->fetch_assoc()) {
$result_data[] = $row;
}
} else {
// Log that no data was found for debugging
$sql . " with params: " . print_r($params, true));

error_log("No data found for SQL: " .
// Return an empty JSON array as

expected by the JavaScript when no data is found

echo json_encode([]);

exit(); //

Terminate script execution after sending empty array
}

} catch (Exception $e) {
// Log any caught exceptions

error_log("Caught Exception in fetch_metabolites.php: " .

$e->getMessage() . " SQL: " . $sql . " Params: " . print_r($params, true));
error message for the frontend

// Return a JSON

echo json_encode(["error" => $e->getMessage(),

"sql_query" => $sql, "params" =>
$params]);

exit(); // Terminate script execution after

sending error
}
69/166

$conn->close();

// Finally, encode and echo the results (which could be an empty array if no data was
found earlier and exit() was not called) echo json_encode($result_data);
?>

