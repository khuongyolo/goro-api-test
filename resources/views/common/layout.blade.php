<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #1e1e1e; /* Dark background for the whole page */
            color: #dcdcdc; /* Light text color for contrast */
            margin: 20px;
        }
        #error-container {
            background-color: #2d2d2d; /* Darker background for the container */
            border-radius: 8px; /* Rounded corners */
            padding: 20px; /* Padding around the content */
            overflow: auto; /* Handle overflow if the content is too large */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5); /* Optional: shadow for better visibility */
        }
        pre {
            white-space: pre-wrap; /* Preserve formatting */
            word-wrap: break-word; /* Wrap long lines */
            color: #c5c5c5; /* Light color for the JSON */
            margin: 0; /* Remove default margins */
        }
        code {
            font-family: 'Courier New', Courier, monospace; /* Monospace font for code */
        }
    </style>
</head>
<body>
    @yield('content')
</body>
</html>
