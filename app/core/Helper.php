<?php

function jenjang($jenjang)
{
    switch ($jenjang) {
        case "J01":
            $j = "MI";
            break;
        case "J02":
            $j = "SMP";
            break;
        case "J03":
            $j = "SMA";
            break;
        case "J04":
            $j = "SMK-BM";
            break;
        case "J05":
            $j = "SMK-FAR";
            break;
    }

    return $j;
}

function redirect($url = null)
{
    header('location:' . BASEURL . $url);
}
