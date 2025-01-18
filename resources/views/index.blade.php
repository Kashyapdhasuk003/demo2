<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Full Page Image</title>
    <style>
    
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

    
        .full-page-image {
            width: 80%;
            height: 100%; 
            background: url('{{URL('images/cat.png')}}') no-repeat center center;
            background-size: cover; 
        }
    </style>
</head>
<body>
    <div class="full-page-image">
   
    </div>
</body>
</html>
