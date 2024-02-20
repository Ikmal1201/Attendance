<?php
require __DIR__ . '/vendor/autoload.php'; // Path to autoload.php from the Google API PHP client library

use Google\Client as Google_Client;
use Google\Service\Sheets as Google_Service_Sheets;
use Google\Service\Sheets\Google_Service_Sheets_ValueRange;

// Set up the Google Sheets API client
$client = new Google_Client();
$client->setAuthConfig([
    "type" => "service_account",
    "project_id" => "kehadiran-414704",
    "private_key_id" => "8212be07f4d019ea7cc354acc266d9acbeea2f79",
    "private_key" => "-----BEGIN PRIVATE KEY-----\nMIIEvQIBADANBgkqhkiG9w0BAQEFAASCBKcwggSjAgEAAoIBAQDRMMuvtwS/zWJ+\nzG83NhlfuF+Y6fMIckMMHl+zGV3IaVJOWfEsBPt6Tlj4BrnsXwLoGsoKJXrtIE44\nt8y4DbJ1P+seiM3U4yamGBXNODmY4RPOAs6UM/5I7NmiqNkRyKyRFjIBEjnZYT1D\nUgUsm5M4XBOM0fSddMgVwW9K8bWcngH1h7vkPdYAakxl4LjsBMX2KCaMU+zFlhrQ\n8NERJZwnLZ+AzSKfs7IPRjZB44r0PEp0bKM2Lj/BEBuV0my30JpoX/L8fYknvPvP\n1alc1EQjC/FSfeQnXjmjN8KvyC3jLa114l0Lm+Lq4U38ElwRfFs6uw3wCo2SLzot\narAdll5DAgMBAAECggEABAONLPp0h1+f/7HZgnQxyXHmt67pgGR839snV+7pK0LG\nFwXHyGHyF1cwgtXSNHRgQGbfMJGmia1AgvsX3QI6ReCrmMLkPCz9nVtB89Wb2VCc\nSiwonZRf0TNmO6ZEwAAbO49y9y1L2d1xSPzmZ4Q2r3Ko119h87F9c1lqUsRPiUk/\n9zp+o50KwA3qgpJPgihKVRaEzxx9llZtue8j/Z0MJT35WErsKTS7YA37WDYHzMue\nEg+CKOyM47XyXzKYBy3fXD2sXykKU5OsDVBN8yysEIukXCmw1yhUI0LEf6SSH3mA\nGoqcxWhmyJrQ78EtqPl7NxiK1q4ayDu5pUMR8W4aTQKBgQD2vW9tjtNPnSXdWSGC\nCmVJfZHh5e0US7ITppycx0vKtqTIE6E2/QsJOv478KC8baf8PayDm70O0+Dmp0h2\nPgjGFr830VMMCSMEPWR4XqEJUTJgVa74k0r2UXSRApsgohM2/W+UnKtfzBwE24Gm\nFslq4x65PnfCDsrX5LqxHUCJfQKBgQDZCpprbGI0u7A3K4YYJcLPJhDx+HwUQuva\nTeFmuWd0wJ5NJHCJLdOZGGhD+T0asxP5/3Z8JLsgymfi9kgpNoSj8iSGecPjSsc8\nsJnaefN2BEuW7lgHmfHQ49lu3ru0ykpJrLlcbksq3h05IcNrVi3ChXcW3L5eU4y3\nlgDgdukSvwKBgGdgYwkh6ALZMn4U0+cp99nclHxy2uu/8zIsgj1leqnJ8CwrnUXu\nqusJHm96l72aq+EQ7fCOFZ3aw8WfnMp9nytvaFo4h3TpdxRVrHyKGSpQLK0T+SUI\ngUXGRvJihyAbB7XoZRF8uoh+edbHKQCvV2BDHCI8u+xASlg96sI+IUX5AoGATni9\n8h8CtswxXxEWb36fm6PItqO/wNedTJWh7DEWjaji00NciMyP16dyczkW9aNPkrDh\nlur02Vs1CmM/Hd9/P4NZ32EBCRnNRU0Yo1w6QS42YkCUhVMMkhj/UU2okiodh9uy\nPRAHj101NaXWcOV8r/rvXs266oHMu8e5U27KwCMCgYEAj3acq/T5ywMqOra737bv\nFZ/CrOvTe98oc7r++e23FhvZW3+IYtipU68SbgXiDYLSOj4NJLY+YWsKj6v6GZFU\n5lOJ91XuJWD40AFyRBPFZCXIl7/6rl5dZi2bVqJePTC4yJB1JBIv/udY7PhQbSIx\niLvnXeiTCETnQ+3wNKIQxfI=\n-----END PRIVATE KEY-----\n",
    "client_email" => "kehadiran@kehadiran-414704.iam.gserviceaccount.com",
    "client_id" => "108094593953366570110",
    "auth_uri" => "https://accounts.google.com/o/oauth2/auth",
    "token_uri" => "https://oauth2.googleapis.com/token",
    "auth_provider_x509_cert_url" => "https://www.googleapis.com/oauth2/v1/certs",
    "client_x509_cert_url" => "https://www.googleapis.com/robot/v1/metadata/x509/kehadiran%40kehadiran-414704.iam.gserviceaccount.com",
    "universe_domain" => "googleapis.com"
]);

// Set access type and scopes
$client->setAccessType('offline');
$client->setScopes([Google_Service_Sheets::SPREADSHEETS]);

// Create Google Sheets service
$service = new Google_Service_Sheets($client);

// Specify your spreadsheet ID and range
$spreadsheetId = '15lGgRd3BRda7iBIibPmj9SzynV6NYSrTETmfKiyx4TY';
$range = 'DATA LENGKAP MC'; // Change this to the actual sheet name

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Get form data
    $data = [
        $_POST['dari_mana'],
        $_POST['nama'],
        $_POST['no_tel'],
        $_POST['emel'],
        $_POST['daerah'],
        $_POST['mukim'],
        $_POST['alamat'],
        $_POST['negeri'],
        $_POST['id_ejen'],
        $_POST['text_field'],
        $_POST['catatan'],
        implode(', ', $_POST['attendance']), // Convert array to comma-separated string for attendance
        $_POST['coaching_cvo'],
        $_POST['preview'],
        $_POST['kekerapan_kehadiran']
    ];

    // Prepare the values for the API request
    $values = [$data];

    // Append the data to the sheet
    $body = new Google_Service_Sheets_ValueRange(['values' => $values]);
    $result = $service->spreadsheets_values->append($spreadsheetId, $range, $body, ['valueInputOption' => 'RAW']);

    if ($result) {
        echo 'Data submitted successfully!';
    } else {
        echo 'Error submitting data.';
    }
}
?>
