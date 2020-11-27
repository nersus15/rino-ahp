<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Resource group "main"
$config['themes']['main']['js'] = array(
    array('pos' => 'head', 'src' => 'vendor/jquery/jquery-3.3.1.min.js'),
    array('pos' => 'head', 'src' => 'vendor/jquery/jquery.form.js'),
    array('pos' => 'head', 'src' => 'vendor/bootstrap/js/popper.min.js'),
    array('pos' => 'head', 'src' => 'vendor/bootstrap/js/bootstrap.min.js'),
    array('pos' => 'head', 'src' => 'vendor/bootstrap-notify/bootstrap-notify.min.js'),
    array('pos' => 'head', 'src' => 'vendor/jquery-validation/dist/jquery.validate.min.js'),
    array('pos' => 'head', 'src' => 'vendor/moment/moment.min.js'),
    array('pos' => 'head', 'src' => 'vendor/kamscore/js/Kamscore.js'),
    array('pos' => 'head', 'src' => 'vendor/kamscore/js/uihelper.js'),
    array('pos' => 'body:end', 'src' => 'js/main.js')
);

$config['themes']['main']['css'] = array(
    array('pos' => 'head', 'src' => 'vendor/bootstrap/css/bootstrap.min.css'),
    array('pos' => 'head', 'src' => 'vendor/fontawesome/css/all.min.css'),
    array('pos' => 'head', 'src' => 'vendor/fontawesome/css/all.min.css'),
    array('pos' => 'head', 'src' => 'vendor/dore/icon/iconsmind/style.css'),
    array('pos' => 'head', 'src' => 'vendor/dore/icon/simple-line-icons/css/simple-line-icons.css')
);


// Dore themes
$config['themes']['dore']['css'] = array(
    array('pos' => 'head', 'src' => 'vendor/dore/css/dore.light.green.css'),
    array('src' => 'vendor/dropzone/css/dropzone.min.css', 'pos' => 'head'),
    array('pos' => 'head', 'src' => 'vendor/dore/css/main.css')
);
$config['themes']['dore']['js'] = array(
    array('pos' => 'head', 'src' => 'vendor/dropzone/js/dropzone.min.js'),
    array('pos' => 'head', 'src' => 'vendor/dore/js/script.js'),
    array('pos' => 'head', 'src' => 'vendor/dore/js/dore.script.js'),
);

$config['themes']['datatables']['css'] = array(
    array('src' => 'vendor/datatables/dataTables.bootstrap4.min.css', 'pos' => 'head'),
    array('src' => 'vendor/datatables/datatables.responsive.bootstrap4.min.css', 'pos' => 'head'),
);

$config['themes']['datatables']['js'] = array(
    array('pos' => 'head', 'src' => 'vendor/datatables/datatables.min.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/buttons.datatables.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/dt.select.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/btn.zip.js'),
    // array('pos' => 'head', 'src' => 'vendor/datatables/btn.pdf.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/btn.pfs.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/btn.html-buttons.js'),
    array('pos' => 'head', 'src' => 'vendor/datatables/btn.print.js'),
);