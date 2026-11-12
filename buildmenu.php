<?php
/** Build the shared site navigation for home, catalog, and account pages. */
function koseuBuildMenu() {
    global $CFG;

    $home = rtrim($CFG->apphome, '/');
    $tsugi = rtrim($CFG->wwwroot, '/');
    $escape = function ($value) {
        return htmlspecialchars($value, ENT_QUOTES, 'UTF-8');
    };
    $set = new \Tsugi\UI\MenuSet();
    $logo = $home . '/branding/ChatGPT%20Image%20Nov%204%2C%202026%2C%2009_05_02%20AM-2.png';
    $set->setHome(
        '<span class="koseu-logo-frame">'
            . '<img class="koseu-logo" src="' . $escape($logo) . '" alt="Koseu — Learn with purpose">'
            . '</span>',
        $home
    );
    $catalog = $tsugi . '/catalog';
    $set->addLeft('Courses', $catalog);
    $set->addLeft('Categories', $catalog);

    if ( \Tsugi\Core\ReqScope::isLoggedInLegacy() ) {
        $set->addLeft('Instructor', $tsugi.'/instructor');
        $account = new \Tsugi\UI\Menu();
        $account->addLink('Profile', $home.'/profile');
        if ( !empty($CFG->google_map_api_key) ) {
            $account->addLink('Learner map', $home.'/map');
        }
        if ( !empty($CFG->badge_encrypt_password) ) {
            $account->addLink('Badges', $home.'/badges');
        }
        if ( !empty($CFG->google_classroom_secret) ) {
            $account->addLink('Google Classroom', $tsugi.'/gclass/login');
        }
        if ( ($_COOKIE['adminmenu'] ?? '') === 'true' ) {
            $account->addLink('Administer', $tsugi.'/admin/');
        }
        $account->addLink('Log out', $home.'/logout');
        $set->addRight(\Tsugi\UI\Output::avatarMenuTrigger(), $account);
    } else {
        $set->addRight('Log in', $home . '/register.php?to=login', false, 'class="koseu-login"');
    }
    return $set;
}
