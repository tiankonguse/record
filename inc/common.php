<?php
!defined("ROOT") && define("ROOT", $_SERVER['DOCUMENT_ROOT']);

require ROOT."/common/inc/common.php";

!defined("MAIN_DOMAIN")  && define("MAIN_DOMAIN", DOMAIN."/record/");
!defined("MAIN_PATH")  && define("MAIN_PATH", "/record/");

require BASE_INC . "init.php";
require BASE_INC . "php_version.php";
require BASE_INC . "JSON.php";