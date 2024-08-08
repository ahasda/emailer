<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>

<style>
    form {
        display: flex;
        flex-direction: column;
        width: 300px;
        margin: 0 auto;
    }

    label,
    input {
        margin-bottom: 10px;
    }

    input[type="submit"] {
        align-self: center;
    }
</style>

<body>


    <div class="container">
        <div class="row">
            <div class="col-sm-12 mt-5">
                <div class="card">
                    <h1 class="text-center mb-4">Upload Your Image</h1>
                    <form action="upload.php" method="post" enctype="multipart/form-data">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name">

                        <label for="email">Email</label>
                        <input type="email" name="email" id="email">

                        <label for="fileToUpload">Select image to upload:</label>
                        <input type="file" name="file" id="fileToUpload">

                        <input type="submit" value="Upload Image" name="submit">
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

</html>