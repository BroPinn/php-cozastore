<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>404 - Page Not Found | Coza Store</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;700&display=swap" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            text-align: center;
        }
        .container {
            background-color: white;
            padding: 50px;
            border-radius: 10px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
            max-width: 600px;
            width: 100%;
        }
        .error-code {
            font-size: 120px;
            color: #ff6f61;
            font-weight: bold;
            margin-bottom: 20px;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
        }
        .error-message {
            font-size: 24px;
            color: #333;
            margin-bottom: 20px;
        }
        .error-description {
            color: #666;
            margin-bottom: 30px;
        }
        .btn {
            display: inline-block;
            background-color: #ff6f61;
            color: white;
            padding: 12px 24px;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        .btn:hover {
            background-color: #ff5f51;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="error-code">404</div>
        <h1 class="error-message">Page Not Found</h1>
        <p class="error-description">
            Oops! The page you are looking for seems to have gone missing. 
            It might have been moved or deleted.
        </p>
        <a href="index.php?page=index" class="btn">Return to Home</a>
    </div>
</body>
</html>