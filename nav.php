<?php
$OUTPUT->bodyStart();
$R = rtrim($CFG->apphome, '/') . '/';
$T = rtrim($CFG->wwwroot, '/') . '/';
require_once __DIR__ . '/buildmenu.php';
$OUTPUT->topNavSession(koseuBuildMenu());
$OUTPUT->topNav();
$OUTPUT->flashMessages();
