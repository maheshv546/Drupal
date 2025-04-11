protected function refreshThemeConfig(): void {
  \Drupal::service('config.factory')->reset('system.theme.global');
  \Drupal::service('theme_handler')->refreshInfo();
  \Drupal::service('theme.manager')->resetActiveTheme();
}