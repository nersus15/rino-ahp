<!DOCTYPE html>
<html lang="id">

<head>
    
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta property="og:type" content="website" >
    <meta name="description" content="<?php echo isset($desc) ? $desc : 'Toko Online (ini deskripsi)'?>">
    <meta http-equiv="Content-Type" content="text/html;charset=UTF-8">
    <meta name="keywords" content="marketplace">
    <meta name="keywords" content="online shop">
    <meta name="keywords" content="toko">
    <meta property="og:title" content="<?php echo isset($konten) ? $konten : 'Toko Online' ?>">
    <meta property="og:description" content="<?php echo isset($desc) ? $desc : 'Toko Online (ini deskripsi)'?>">
    <meta property="og:url" content="<?php echo base_url() ?>">
    <meta property="og:image" content="<?php echo isset($thumb) ? base_url('public/assets/img/' . $thumb)  : base_url('public/assets/img/logo/logo.svg') ?>">
    <meta property="og:image:width" content="2250" />
    <meta property="og:image:height" content="2250" />
    <link rel="icon" type="image/gif" href="<?php echo base_url('public/assets/img/logo/logo.svg') ?>">
    
    <title><?php echo isset($title) ? $title : 'Toko Online'; ?></title>

    <?php
    if (isset($resource) && !empty($resource)) {
        foreach ($resource as $k => $v) {
            echo addResourceGroup($v);
        }
    }
    if (isset($extra_js) && !empty($extra_js)) {
        foreach ($extra_js as $js) {
            if ($js['pos'] == 'head' && $js['type'] == 'file')
                echo '<script src="' . base_url('public/assets/' . $js['src']) . '"></script>';
            elseif ($js['pos'] == 'head' && $js['type'] == 'cache')
                echo '<script type="application/javascript" src="' . base_url('public/assets/' . $js['src']) . '"></script>';
            elseif ($js['pos'] == 'head' && $js['type'] == 'inline') {
                echo '<script>' . $js['script'] . '</script>';
            }
            elseif($js['pos'] == 'head' && $js['type'] == 'cdn')
                echo '<script src="' . $js['src'] . '"></script>';
        }
    }

    if (isset($extra_css) && !empty($extra_css)) {
        foreach ($extra_css as $css) {
            if ($css['pos'] == 'head' && $css['type'] == 'file')
                echo '<link rel="stylesheet" href="' . base_url('public/assets/' . $css['src']) . '"></link>';
            elseif ($css['pos'] == 'head' && $css['type'] == 'inline') {
                echo '<style>' . $css['style'] . '</style>';
            }
            elseif($css['pos'] == 'head' && $css['type'] == 'cdn')
                echo '<link rel="stylesheet" href="' .  $css['src'] . '"></link>';

        }
    }
    ?>
    <script>
        var path = location.origin + '/';
        var data_dari_siswa = ['4101', '4102', '4103'];
        var kas_kecil = ['K01', 'K02', 'K03', 'K04', 'K05'];
    </script>
</head>

<body id="app-container" class="<?php echo isset($sembunyikanSidebar) && $sembunyikanSidebar ? 'menu-hidden' : 'menu-default';?> show-spinner">
    <div class="c-overlay">
        <div class="c-overlay-text">Loading</div>
    </div>