protected function refreshThemeConfig(): void {
  \Drupal::service('config.factory')->reset('system.theme.global');
  \Drupal::service('theme_handler')->refreshInfo();
  \Drupal::service('theme.manager')->resetActiveTheme();
}

\Drupal::service('theme.manager')->resetActiveTheme();
\Drupal::service('theme_handler')->refreshInfo();
\Drupal::service('config.factory')->reset('system.theme.global');
\Drupal::service('cache.render')->deleteAll();
\Drupal::service('cache.page')->deleteAll();
\Drupal::service('cache.dynamic_page_cache')->deleteAll();