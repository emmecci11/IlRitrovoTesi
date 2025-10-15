<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <title>Error</title>
        <link href="/IlRitrovo/src/Smarty/css/styles.css" rel="stylesheet">
    </head>
    <body>
        <section>
            <h1>An error has occoured: </h1>
            <p>{$errorMessage|escape}</p>
            <p><a href="javascript:history.back()">Back</a></p>
        </section>
    </body>
</html>