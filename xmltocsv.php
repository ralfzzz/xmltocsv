<?php

$xmlFilePath = 'data.xml';

// Check if the file exists
if (!file_exists($xmlFilePath)) {
    die("XML file '$xmlFilePath' not found.");
}

// Load the XML file using DOMDocument
$dom = new DOMDocument();
$dom->load($xmlFilePath);

$rows = $dom->getElementsByTagName('Row');

// Open the CSV file for writing
$fp = fopen('output.csv', 'w');

$header = true;

foreach ($rows as $row) {
    $rowData = [];

    // Iterate through each cell in the row
    $cells = $row->getElementsByTagName('Cell');
    foreach ($cells as $cell) {
        // Append the cell data to the row data array
        $data = $cell->nodeValue;
        $rowData[] = $data;
    }

    // Write the row data to the CSV file
    if ($header) {
        fputcsv($fp, $rowData);
        $header = false;
    } else {
        fputcsv($fp, $rowData);
    }
}

// Close the CSV file
fclose($fp);

// Output success message
echo "CSV file generated successfully.";

?>
