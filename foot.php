<?php
$home = htmlspecialchars($CFG->apphome, ENT_QUOTES, 'UTF-8');
$foot = <<<HTML
<footer class="koseu-footer">
    <div>
        <strong>Koseu</strong> · Learn with purpose.
    </div>
    <div>
        <a href="{$home}/privacy">Privacy</a> &nbsp; · &nbsp; <a href="https://www.tsugi.org">Powered by Tsugi</a> &nbsp; · &nbsp; <a href="https://www.learnxp.com">Learning Experiences</a>
    </div>
</footer>
HTML;
$OUTPUT->setAppFooter($foot);
$OUTPUT->footer();
