function voya_deep_content_views_pre_view(ViewExecutable $view, string $display_id, array &$args): void {
  if ($view->id() !== 'deep_content' || empty($args[0])) {
    return;
  }

  /** @var \Drupal\voya_deep_content\TagsHelper $tagsHelper */
  $tagsHelper = \Drupal::service('voya_deep_content.tags_helper');
  $tagsHelper->load();

  $resources = $tagsHelper->tags['RESOURCES'] ?? [];
  $key = strtoupper($args[0]);

  if (isset($resources[$key])) {
    $args[0] = $resources[$key];
  }
}