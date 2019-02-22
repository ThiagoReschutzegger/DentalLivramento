<?php
//Listar diretórios e retornar array com todas as pastas e subpastas
//function getFolders($dir = false) {
//    $server_sign = filter_input(INPUT_SERVER, 'SERVER_SIGNATURE', FILTER_SANITIZE_STRING);
//    $unix_server = (stristr($server_sign, "win")) ? false : true;
////    (teste)? verdadeira: falsa;
//    $slash = ($unix_server) ? "/" : "\\";
//    $dir = (!$dir) ? getcwd() : $dir;
//    $open_dir = opendir($dir);
//    $folders = [];
//    while ($item = readdir($open_dir)) {
//        if ($item != "." && $item != "..") {
//            $path = filetype(realpath($dir . $slash . $item));
//            if ($path == "dir") {
//                $folders[] = $item;
//                foreach (getFolders(realpath($dir . $slash . $item)) as $folder) {
//                    $folders[] = $item . $slash . $folder;
//                }
//            }
//        }
//    }
//    return $folders;
//}

function autoLoad($class) {
    $found = false;
    if (file_exists("$class.class.php")) {
        include_once "$class.class.php";
        $found = true;
    } elseif (file_exists("$class.php")) {
        include_once "$class.php";
        $found = true;
    } else {
//        $folders = getFolders();//Muito lento
        $folders = ['model','view','controller','system'];//Procurar em pastas principais
        foreach ($folders as $folder) {
            if (file_exists("$folder/$class.class.php")) {
                include_once "$folder/$class.class.php";
                $found = true;
                return $found;
            } elseif (file_exists("$folder/$class.php")) {
                    include_once "$folder/$class.php";
                    $found = true;
                    return $found; 
            }
        }
    }
    return $found;
}

spl_autoload_register("autoLoad");
$controller = new Controller();
$controller->route(filter_input(INPUT_GET,'query'));