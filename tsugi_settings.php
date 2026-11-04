<?php
if ( ! isset($CFG) ) {
    http_response_code(404);
    exit;
}

/**
 * Public Koseu settings, included by tsugi/config.php before setup.php.
 * Keep deployment URLs, database credentials, and secrets in config.php.
 */
$CFG->servicename = 'Koseu';
$CFG->servicedesc = 'Learn with purpose';
$CFG->context_title = 'Koseu';
$CFG->ownername = 'Charles Severance';
$CFG->owneremail = 'csev@example.com';
$CFG->providekeys = true;

$CFG->theme = array(
    'primary' => '#1e1b6b',
    'secondary' => '#ffffff',
    'text' => '#374151',
    'text-light' => '#626b81',
    'font-url' => 'https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Manrope:wght@600;700;800&display=swap',
    'font-family' => "'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif",
    'font-size' => '16px',
);

// Koseu hosts multiple courses; no site-wide file-based lesson manifest.
$CFG->lessons = false;
$CFG->show_courses_widget = true;
$CFG->show_course_catalog = true;
$CFG->privacy_url = $CFG->apphome . '/privacy';

$CFG->tool_folders = array('admin', '../tools', '../mod');
$CFG->install_folder = $CFG->dirroot . '/../mod';
$CFG->badge_path = $CFG->dirroot . '/../badges';

// Load the same chrome on direct Tsugi URLs, including a fresh catalog visit.
$CFG->extra_css = file_get_contents(__DIR__ . '/assets/koseu.css');
$CFG->top_menu_callback = function () {
    require_once __DIR__ . '/buildmenu.php';
    return koseuBuildMenu();
};
