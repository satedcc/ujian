<?php

$files = directory_map('./dir/assets/img/', FALSE, TRUE);


foreach ($files as $f) {
    $x =  explode(".", $f);
    if ($x[1] == "mp4" || $x[1] == "mpeg" || $x[1] == "mkv" || $x[1] == "MP4" || $x[1] == "MPEG" || $x[1] == "MKV") {
        echo "<li>
                <input type='radio' name='gambar' id='$f' value='" . $f . "'>
                <label for='$f'>
                    <video controls>
                        <source src='" . base_url() . "dir/assets/img/$f' type='video/mp4'>
                        Your browser does not support the video tag.
                    </video>
                </li>
            </li>";
    } else {
        echo "<li>
                <input type='radio' name='gambar' id='$f'  value='" . $f . "'>
                <label for='$f'><img src='" . base_url() . "dir/assets/img/$f'></label>
            </li>";
    }
}
