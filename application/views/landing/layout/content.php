<?php
// Gabungkan semua bagian layout
require_once('header.php');
require_once('menu.php');
require_once('search.php');
if ($content) {
    $this->load->view($content);
}
require_once('footer.php');
