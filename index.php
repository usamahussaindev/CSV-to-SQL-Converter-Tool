<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CSV to SQL Converter</title>
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

.file-container {
    display: flex;
    flex-direction: column;
}

label {
    display: block;
    margin-bottom: 10px;
    font-weight: bold;
}

.input-wrapper {
    position: relative;
    width: 100%;
}

input[type="file"] {
    width: 100%;
    padding: 10px;
    margin-bottom: 20px;
    box-sizing: border-box;
    border: 1px solid #ccc;
    border-radius: 4px;
}

input[type="file"]:hover {
    border-color: #4caf50;
}

.choose-btn {
    position: absolute;
    top: 0;
    right: 0;
    background-color: #4caf50;
    color: #fff;
    padding: 10px 15px;
    border: none;
    border-radius: 0 4px 4px 0;
    cursor: pointer;
}

.choose-btn:hover {
    background-color: #45a049;
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

.drop-area {
            border: 2px dashed #ccc;
            border-radius: 8px;
            padding: 20px;
            text-align: center;
            margin-bottom: 20px;
        }

        .drop-area:hover {
            border-color: #4caf50;
        }
        
    </style>
</head>
<body>
    <header>
        <h1>CSV to SQL Converter</h1>
    </header>
    
    <nav>
        <a href="#">Home</a>
        <a href="#">About</a>
        <a href="#">Contact</a>
    </nav>

    <form action="process.php" method="post" enctype="multipart/form-data" id="upload-form">
        <div class="drop-area" id="dropArea">
            <p>Drag and drop your CSV file here or</p>
            <label for="csvFile">Choose CSV file:</label>
            <input type="file" name="csvFile" id="csvFile" accept=".csv">
        </div>
        <button type="submit" name="submit">Upload</button>
    </form>

    <script>
        const dropArea = document.getElementById('dropArea');

        // Prevent default behavior for drag-and-drop events
        ['dragenter', 'dragover', 'dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, preventDefaults, false);
            document.body.addEventListener(eventName, preventDefaults, false);
        });

        function preventDefaults(e) {
            e.preventDefault();
            e.stopPropagation();
        }

        // Highlight drop area when a file is dragged over it
        ['dragenter', 'dragover'].forEach(eventName => {
            dropArea.addEventListener(eventName, highlight, false);
        });

        ['dragleave', 'drop'].forEach(eventName => {
            dropArea.addEventListener(eventName, unhighlight, false);
        });

        function highlight() {
            dropArea.classList.add('highlight');
        }

        function unhighlight() {
            dropArea.classList.remove('highlight');
        }

        // Handle dropped files
        dropArea.addEventListener('drop', handleDrop, false);

        function handleDrop(e) {
            const files = e.dataTransfer.files;
            document.getElementById('csvFile').files = files;
        }
    </script>
</body>
</html>