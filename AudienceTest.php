function voya_deep_content_views_post_render(ViewExecutable $view, array &$output, CachePluginBase $cache): void {
  if ($view->id() !== 'deep_content') {
    return;
  }

  $textResponse = $output['#markup']->jsonSerialize();
  $newText = $textResponse;
  $newText = str_replace('"{\\', '{', $newText);
  $newText = str_replace('}"', '}', $newText);
  $newText = str_replace('\\"', '"', $newText);
  $newText = str_replace("\u0022", '"', $newText);
  $newText = str_replace("u0022", '"', $newText);
  $newText = str_replace("\u0027", '\'', $newText);

  $newText = DeepContentModule::filterDeepContentViewsOutput($newText);

  $output['#markup'] = $newText;
}

Error: Call to a member function jsonSerialize() on null in voya_deep_content_views_post_render() (line 140 of /app/docroot/sites/resourcecenter/modules/voya_deep_content/voya_deep_content.module)
