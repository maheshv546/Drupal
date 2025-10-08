function voya_deep_content_views_pre_view(ViewExecutable $view, string $display_id, array &$args): void {
  $viewId = $view->id();
  if ($viewId !== 'deep_content') {
    return;
  }
  // IF RESOURCE NAME IS PASSED, SWAP IT FOR RESOURCE ID.
  $tagsHelper = \Drupal::service('voya_deep_content.tags_helper');
  $tagsHelper->load();
  $resourceId = $tagsHelper->tags['RESOURCES'][strtoupper($args[0])];
  if ($resourceId) {
    $args[0] = $resourceId;
  }
}

Exception: Warning: Undefined array key ""
voya_deep_content_views_pre_view()() (Line: 94)
