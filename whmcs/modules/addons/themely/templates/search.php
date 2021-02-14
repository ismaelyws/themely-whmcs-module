<?php
if (isset($_POST['search_param'])) {
  $search_param = htmlspecialchars(trim($_POST['search_param']));
  $url = 'https://d108fh6x7uy5wn.cloudfront.net/themes.json';
  $curl = curl_init();
  curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($curl, CURLOPT_URL, $url);
  $json = curl_exec($curl);
  $array = json_decode($json, true);
  $themes = array_filter($array['themes'], function ($theme) use ($search_param) {
      return (preg_match("/$search_param/i", $theme['name']) or preg_match("/$search_param/i", $theme['description']));
  });
  if ($themes) {
    foreach ($themes as $theme) {
      echo '<div class="col-xs-12 col-sm-6 col-md-6 col-lg-4">
          <div class="thumbnail">
          <a href="' . htmlspecialchars( $theme['preview_url'] ) . '?ref=themely" target="_blank"><img src="' . htmlspecialchars( $theme['screenshot_url'] ) . '" title="' . gettext("Preview") . ' ' . htmlspecialchars( $theme['name'] ) . '" class="w-100 rounded-top"></a>
            <div class="caption">
              <div class="row">
                <div class="col-xs-6 col-md-6 no-padding-right">
                  <span class="name"><strong>' . htmlspecialchars( $theme['name'] ) . '</strong></span>
                  <span class="author small"><span class="text-muted"><em>' . gettext("by") . '</em></span> ' . htmlspecialchars( $theme['author'] ) . '</span>
                </div>
                <div class="col-xs-6 col-md-6 text-right no-padding-left">
                  <a href="' . htmlspecialchars( $theme['preview_url'] ) . '?ref=themely" target="_blank" class="btn btn-sm btn-outline" title="' . gettext("Preview") . ' ' . htmlspecialchars( $theme['name'] ) . '"><i class="fas fa-eye fa-fw"></i></a>
                  <button class="btn btn-sm btn-primary" title="' . gettext("Select theme to install") . '" data-themeurl="' . htmlspecialchars( $theme['download_url'] ) . '" data-themeslug="' . htmlspecialchars( $theme['theme_slug'] ) . '" name="theme">Select</button>
                </div>
              </div>
            </div>
          </div>
        </div>';
    }
  } else {
    echo "<div class='col-md-12'><div class='alert alert-danger'>No themes found, try with a different search term.</div></div>";
  }
};