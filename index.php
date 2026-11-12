<?php
require __DIR__ . '/utm-live.php';
require 'top.php';
?>
<script>
    (function () {
      var url = new URL(window.location.href);
      if (url.searchParams.has('utm') && !url.searchParams.has('utm_source')) {
        url.searchParams.set('utm_source', url.searchParams.get('utm'));
        window.history.replaceState({}, '', url);
      }
    })();
</script>
<?php
require 'nav.php';
$courses = $PDOX ? \Tsugi\Controllers\Catalog::listingRows() : [];
$query = trim(is_string($_GET['q'] ?? null) ? $_GET['q'] : '');
$escape = function ($value) { return htmlspecialchars($value, ENT_QUOTES, 'UTF-8'); };
$loggedIn = \Tsugi\Core\ReqScope::isLoggedInLegacy();
$loginUrl = $escape(rtrim($CFG->apphome, '/') . '/register.php?to=login');
?>
<div class="koseu-home">
    <aside class="beta-notice" aria-label="Beta test notice">
        <div class="koseu-wrap beta-notice-inner">
            <span class="beta-stamp" aria-hidden="true">Soon</span>
            <div class="beta-copy">
                <p class="beta-title">Beta test coming soon</p>
<?php if ($loggedIn) { ?>
                <p>The flag is up. The gate isn’t. This account will be notified when beta testing begins.</p>
<?php } else { ?>
                <p>The flag is up. The gate isn’t. <a href="<?= $loginUrl ?>">Log in</a> to create an account and be notified when beta testing begins.</p>
<?php } ?>
            </div>
<?php if (!$loggedIn) { ?>
            <a class="beta-login" href="<?= $loginUrl ?>">Log in <span aria-hidden="true">→</span></a>
<?php } ?>
        </div>
    </aside>
    <section class="koseu-hero" aria-labelledby="hero-title">
        <div class="koseu-wrap hero-layout">
            <div class="hero-copy">
                <p class="eyebrow">Learning that takes you places</p>
                <h1 id="hero-title">Learn skills for a<br>bigger tomorrow.</h1>
                <p class="hero-lead">Practical learning. Real possibilities.<br>Take your next step, at your own pace.</p>
                <form class="course-search" action="<?= $escape($T) ?>catalog" method="get" role="search">
                    <label for="course-query" class="sr-only">Search learning materials</label>
                    <span aria-hidden="true">⌕</span>
                    <input id="course-query" name="q" type="search" placeholder="What do you want to learn?" value="<?= $escape($query) ?>">
                    <button type="submit">Search <span aria-hidden="true">→</span></button>
                </form>
                <a class="koseu-button" href="<?= $escape($T) ?>catalog">Explore courses <span aria-hidden="true">→</span></a>
            </div>
            <svg class="journey-art" viewBox="0 0 760 600" aria-hidden="true" focusable="false">
                <defs>
                    <linearGradient id="mountain" x2=".6" y2="1">
                        <stop stop-color="#b1b3ef"/>
                        <stop offset="1" stop-color="#789de7"/>
                    </linearGradient>
                    <linearGradient id="foreground" x2="1" y2="1">
                        <stop stop-color="#e4e4ff"/>
                        <stop offset="1" stop-color="#abc6f5"/>
                    </linearGradient>
                </defs>
                <g fill="#fff" opacity=".65">
                    <path d="M330 130q12-24 36-20q30-55 67-7q29-10 42 27Z"/>
                    <path d="M620 220q14-30 35-18q28-44 55 0q30-8 40 18Z"/>
                    <path d="M65 290q14-28 33-18q25-36 48 0q24-3 32 18Z"/>
                </g>
                <path d="M0 555Q150 385 265 385L475 232Q510 208 540 228L760 370V600H0Z" fill="url(#mountain)"/>
                <path d="M-50 570Q120 370 275 432Q380 480 480 465Q620 450 800 530V650H-50Z" fill="#becbf5"/>
                <path d="M510 220Q425 266 462 286Q600 345 490 389Q360 442 320 600H180Q240 465 415 393Q541 338 438 294Q398 274 510 220Z" fill="#f8f5ff"/>
                <path d="M0 600Q170 610 345 532Q535 454 760 567V650H0Z" fill="url(#foreground)"/>
                <path d="M512 220V128" stroke="#ff7a45" stroke-width="5" stroke-linecap="round"/>
                <path d="M515 128L573 151L515 175Z" fill="#ff7a45"/>
            </svg>
        </div>
    </section>
    <div class="learning-strip koseu-wrap">
        <span>Built for <strong>curious minds</strong></span>
        <span>✦ &nbsp; Practical skills</span>
        <span>◷ &nbsp; Learn at your pace</span>
        <span>◎ &nbsp; Open learning</span>
    </div>
    <section class="koseu-section koseu-wrap" id="learning" aria-labelledby="learning-title">
        <div class="section-heading">
            <div>
                <p class="eyebrow">Your next step starts here</p>
                <h2 id="learning-title">Find your path forward.</h2>
                <p>Discover courses and resources from our learning community.</p>
            </div>
            <a class="koseu-text-link" href="<?= $escape($T) ?>catalog">All courses <span aria-hidden="true">→</span></a>
        </div>
<?php
$shown = array_filter($courses, function ($course) use ($query) {
    return $query === '' || stripos(($course['title'] ?? '').' '.($course['short_description'] ?? ''), $query) !== false;
});
if ($query !== '') { ?>
        <p class="search-result" role="status"><?= count($shown) ?> results for “<?= $escape($query) ?>” · <a href="<?= $escape($R) ?>#learning">Clear search</a></p>
<?php } ?>
        <div class="learning-cards">
<?php $i = 0; foreach ($shown as $course) { $i++;
    $href = $escape($course['href']);
    $target = !empty($course['href_new_window']) ? ' target="_blank" rel="noopener noreferrer"' : '';
?>
            <article class="learning-card">
                <a class="card-art art-<?= (($i-1)%3)+1 ?>" tabindex="-1" aria-hidden="true" href="<?= $href ?>"<?= $target ?>>
<?php if (!empty($course['hero_url'])) { ?>
                    <img class="course-hero-image" src="<?= $escape($course['hero_url']) ?>" alt="" loading="lazy">
<?php } else { ?>
                    <span class="card-symbol"><?= ['&lt;/&gt;', '✦', '{ }'][($i-1)%3] ?></span>
                    <span class="art-orbit"></span>
<?php } ?>
                    <span class="card-label"><?= !empty($course['enrolled']) ? 'Enrolled' : 'Explore & learn' ?></span>
                </a>
                <div class="card-copy">
                    <p class="card-kicker">KOSEU · LEARN WITH PURPOSE</p>
                    <h3><a href="<?= $href ?>"<?= $target ?>><?= $escape($course['title']) ?></a></h3>
                    <p><?= $escape($course['short_description'] ?? '') ?></p>
                    <a class="card-link" href="<?= $href ?>"<?= $target ?>>Explore course <span aria-hidden="true">↗</span></a>
                </div>
            </article>
<?php } ?>
<?php if (!$shown) { ?>
            <div class="no-results">
<?php if ($query !== '') { ?>
                No courses match your search. <a href="<?= $escape($R) ?>#learning">Browse all courses</a>.
<?php } else { ?>
                New learning journeys start here. Published courses will appear as they become available.
<?php } ?>
            </div>
<?php } ?>
        </div>
    </section>
    <section class="koseu-benefits">
        <div class="koseu-wrap koseu-section">
            <p class="eyebrow">Learn with purpose</p>
            <h2>More than watching a video.</h2>
            <div class="benefit-grid">
                <div>
                    <span class="benefit-icon" aria-hidden="true">✧</span>
                    <h3>Put ideas into practice</h3>
                    <p>Connect lessons with activities and tools that help turn knowledge into understanding.</p>
                </div>
                <div>
                    <span class="benefit-icon" aria-hidden="true">↗</span>
                    <h3>Make your own progress</h3>
                    <p>Follow structured materials, revisit a topic, and take the next step when you’re ready.</p>
                </div>
                <div>
                    <span class="benefit-icon" aria-hidden="true">◎</span>
                    <h3>Learning without borders</h3>
                    <p>Access learning materials wherever you are, with a framework built for open education.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="koseu-wrap koseu-section">
        <div class="teaching-banner">
            <div>
                <p class="eyebrow">For educators &amp; creators</p>
                <h2>Have something worth teaching?</h2>
                <p>Build your own learning experience with the open source Tsugi framework.</p>
            </div>
            <a class="koseu-button coral" href="#" onclick="window.alert('Coming soon please login to join our mailing list to be notified when beta testing starts.'); return false;">Apply to teach</a>
        </div>
    </section>
</div>
<?php require 'foot.php';
