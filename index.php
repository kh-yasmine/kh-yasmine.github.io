<?php
session_start();

// Détection de langue
$lang = 'fr';
if (isset($_GET['lang'])) {
    $lang = $_GET['lang'];
    $_SESSION['lang'] = $lang;
} elseif (isset($_SESSION['lang'])) {
    $lang = $_SESSION['lang'];
} elseif (isset($_SERVER['HTTP_ACCEPT_LANGUAGE'])) {
    $navLang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
    if (in_array($navLang, ['fr', 'en', 'ar'])) {
        $lang = $navLang;
    }
}

// Charger XML
$xml = simplexml_load_file("lang/translations.xml");
function t($id, $lang, $xml) {
    $result = $xml->xpath("//block[@id='$id']/$lang");
    return $result ? (string)$result[0] : '';
}

?>
<!DOCTYPE html>
<html lang="<?= $lang ?>" dir="<?= in_array($lang, ['ar']) ? 'rtl' : 'ltr' ?>"  vocab="https://schema.org/" typeof="WebPage">
<head>
  <meta charset="UTF-8">
  <title><?= t('about_title', $lang, $xml) ?> - Yasmine KHALLAAYOUNE</title>
    <meta name="description" content="<?= t('about_intro', $lang, $xml) ?>">
  <link rel="stylesheet" href="css/styles.css">
  <nav class="navbar">
  <ul class="navbar-links">
    <li><a href="#about"><?= t('nav_about', $lang, $xml) ?></a></li>
    <li><a href="#education"><?= t('nav_education', $lang, $xml) ?></a></li>
    <li><a href="#projects"><?= t('nav_projects', $lang, $xml) ?></a></li>
    <li><a href="#ws"><?= t('nav_ws', $lang, $xml) ?></a></li>
    <li><a href="#contact"><?= t('nav_contact', $lang, $xml) ?></a></li>
    <li class="lang-switch">
      <a href="?lang=fr">🇫🇷</a>
      <a href="?lang=en">🇬🇧</a>
      <a href="?lang=ar">🇸🇦</a>
    </li>
  </ul>
</nav>
  <link rel="alternate" hreflang="fr" href="?lang=fr" />
  <link rel="alternate" hreflang="en" href="?lang=en" />
  <link rel="alternate" hreflang="ar" href="?lang=ar" />
</head>
<body>


  <main typeof="Person" resource="#me">
  <section id="about" typeof="Person" vocab="https://schema.org/">
  <h2 property="name"><?= t('about_title', $lang, $xml) ?></h2>
  <p property="description"><?= t('about_intro', $lang, $xml) ?></p>
</section>

<section id="education" vocab="https://schema.org/" typeof="EducationalOccupationalCredential">
  <h2><?= t('education_title', $lang, $xml) ?></h2>
  <ul>
    <li property="educationalProgram"><?= t('edu_1', $lang, $xml) ?></li>
    <li property="educationalProgram"><?= t('edu_2', $lang, $xml) ?></li>
    <li property="educationalProgram"><?= t('edu_3', $lang, $xml) ?></li>
  </ul>
</section>

<section id="projects" vocab="https://schema.org/" typeof="CreativeWork">
  <h2><?= t('projects_title', $lang, $xml) ?></h2>

  <article property="hasPart" typeof="CreativeWork">
    <h3>🟢 Messagerie Client-Serveur</h3>
    <p property="description"><?= t('project_1', $lang, $xml) ?></p>
  </article>

  <article property="hasPart" typeof="CreativeWork">
    <h3>🔵 Unity & Raspberry Pi</h3>
    <p property="description"><?= t('project_2', $lang, $xml) ?></p>
  </article>

  <article property="hasPart" typeof="CreativeWork">
    <h3>🟣 Site parlementaire</h3>
    <p property="description"><?= t('project_3', $lang, $xml) ?></p>
  </article>
</section>

<section id="ws" vocab="https://schema.org/" typeof="CreativeWork">
  <h2 property="name"><?= t('ws_title', $lang, $xml) ?></h2>
  <p property="description"><?= t('ws_intro', $lang, $xml) ?></p>
  <p><?= t('ws_applied', $lang, $xml) ?></p>

  <p>
    🔗 <a href="lang/translations.xml" target="_blank">Voir les traductions XML</a> 
  </p>
</section>

<section id="contact" vocab="https://schema.org/" typeof="Person">
  <h2><?= t('contact_title', $lang, $xml) ?></h2>
  <p><?= t('contact_email', $lang, $xml) ?></p>
  <p>
  ✉️ <a href="mailto:yasminekhallaayoune@gmail.com" property="email">yasmine.khallaayoune@gmail.com</a>
  </p>
  <p>
  🔗 <a href="https://www.linkedin.com/in/yasmine-khallaayoune" target="_blank" property="sameAs">
      <?= t('contact_linkedin', $lang, $xml) ?>
    </a>
  </p>
  <p>
    💻 <a href="https://github.com/kh-yasmine" target="_blank" property="sameAs">
      <?= t('contact_github', $lang, $xml) ?>
    </a>
  </p>
</section>

  

  <section>
    <h2>🎥 Vidéo de présentation</h2>
    <video controls>
      <source src="video/intro_<?= $lang ?>.mp4" type="video/mp4">
      <track src="subtitles/intro_<?= $lang ?>.vtt" kind="subtitles" srclang="<?= $lang ?>" label="<?= strtoupper($lang) ?>" default>
      Votre navigateur ne supporte pas la lecture vidéo.
    </video>
  </section>

  </main>
</body>
</html>
