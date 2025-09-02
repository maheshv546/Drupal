public function resultsPage() {
  // Ensure to include cacheability for request param we are using!
  $cache = new CacheableMetadata();
  $cache->setCacheContexts(['url.query_args:type']);

  $type = strtolower((string) $this->request->getCurrentRequest()->get('type', ''));
  $type_key = str_replace(" ", "_", $type);

  $asset_classes = $type ? $this->getAssetClasses($type_key) : [];
  $risk_levels = $this->getRiskLevels();
  $legal_text = $this->getLegalText();

  $results_page = [
    '#investor_type' => $type,
    '#investor_type_key' => $type_key,
    '#asset_classes' => $asset_classes,
    '#risk_levels' => $risk_levels,
    '#legal_text' => $legal_text,
    '#theme' => 'investor_type_results',
  ];

  $cache->applyTo($results_page);
  return $results_page;
}