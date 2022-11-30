<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/all.min.css">
    <title>Icon</title>
    <style>
        i {
            margin: 5px;
            font-size: 18px;
            transition: .5s;
            padding: 5px;
            border-radius: 3px;
        }

        i:hover {
            transform: scale(1.4);
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.08);
            background: #ddd;
        }
    </style>
</head>

<body>
    <?php

    echo "<h1>Descending</h1>";
    $isi_dir = scandir("svgs/regular", 1);
    foreach ($isi_dir as $data) {
        $x =  str_replace(".svg", "", $data);
        echo "<i class='far fa-$x'></i>";
    }

    echo "<h1>Light</h1>";
    $isi_dir = scandir("svgs/light", 1);
    foreach ($isi_dir as $data) {
        $x =  str_replace(".svg", "", $data);
        echo "<i class='fal fa-$x'></i>";
    }

    echo "<h1>Solid</h1>";
    $isi_dir = scandir("svgs/solid", 1);
    foreach ($isi_dir as $data) {
        $x =  str_replace(".svg", "", $data);
        echo "<i class='fa fa-$x'></i>";
    }

    echo "<h1>Brand</h1>";
    $isi_dir = scandir("svgs/brands", 1);
    foreach ($isi_dir as $data) {
        $x =  str_replace(".svg", "", $data);
        echo "<i class='fab fa-$x'></i>";
    }

    echo "<h1>duotone</h1>";
    $isi_dir = scandir("svgs/duotone", 1);
    foreach ($isi_dir as $data) {
        $x =  str_replace(".svg", "", $data);
        echo "<i class='fad fa-$x'></i>";
    }
    ?>

</body>

</html>