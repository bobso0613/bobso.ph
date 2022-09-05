<?php

require_once("api/CurlAPI.php");
require_once("api/SystemConstants.php");
require_once("api/PageRenderer.php");

$lch_page = @$_GET["page"];

$page_renderer = new PageRenderer($lch_page);
$page_renderer->render();

?>
