<?php
$home = htmlspecialchars($CFG->apphome, ENT_QUOTES, 'UTF-8');
$foot = '<footer class="koseu-footer"><div><strong>Koseu</strong> · Learn with purpose.<br>Creative Commons Attribution 3.0 · Charles R. Severance</div><div><a href="'.$home.'/privacy">Privacy</a> &nbsp; · &nbsp; <a href="https://www.tsugi.org">Powered by Tsugi</a> &nbsp; · &nbsp; <a href="https://github.com/tsugiproject/koseu-site">Source code</a></div></footer>';
$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();
