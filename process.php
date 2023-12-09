<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV to SQL Converter Result</title>
    <style>
        body {
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }

        header {
            background-color: #333;
            padding: 15px;
            text-align: center;
            color: #fff;
        }

        nav {
            background-color: #4caf50;
            padding: 10px;
            text-align: center;
        }

        nav a {
            color: #fff;
            text-decoration: none;
            padding: 10px 20px;
            margin: 0 10px;
            border-radius: 4px;
            background-color: #45a049;
        }

        nav a:hover {
            background-color: #333;
        }

        form {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
            font-weight: bold;
        }

        input[type="file"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 20px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }

        button:hover {
            background-color: #45a049;
        }

        textarea {
            width: 100%;
            height: 200px;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 20px;
        }

        /* New styles for the download section */
        #download-section {
            max-width: 600px;
            margin: 50px auto;
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        #download-button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
            margin-top: 10px;
        }

        #download-button:hover {
            background-color: #45a049;
        }
    </style>
</head>
<body>
    <header>
        <h1>CSV to SQL Converter Result</h1>
    </header>

    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>

    <?php
    if (isset($_POST['submit'])) {
        // Check if file is uploaded without errors
        if ($_FILES['csvFile']['error'] == 0) {
            $csvFile = $_FILES['csvFile']['tmp_name'];
            
            // Read CSV file
            $csvData = file_get_contents($csvFile);
            
            // Convert CSV to SQL queries
            $sqlQueries = convertCsvToSql($csvData);

            // Display SQL queries in a textarea
            echo '<form>';
            echo '<label>SQL Queries:</label>';
            echo '<textarea readonly>' . $sqlQueries . '</textarea>';
            echo '</form>';

            // Display download section with download button
            echo '<div id="download-section">';
            echo '<label>Download SQL Queries:</label>';
            echo '<a href="data:application/sql;charset=utf-8,' . rawurlencode($sqlQueries) . '" download="sql_queries.sql" id="download-button">Download</a>';
            echo '</div>';
        } else {
            echo 'Error uploading file.';
        }
    }

    function convertCsvToSql($csvData) {
        // Parse CSV data
        $lines = explode("\n", $csvData);
        $headers = str_getcsv(array_shift($lines));
        
        // Generate SQL queries
        $sqlQueries = [];
        foreach ($lines as $line) {
            $data = str_getcsv($line);
            $sqlQueries[] = "INSERT INTO your_table_name (" . implode(', ', $headers) . ") VALUES ('" . implode("', '", $data) . "');";
        }

        // Combine queries into a string
        $sqlString = implode("\n", $sqlQueries);

        return $sqlString;
    }
    ?>
</body>
</html>