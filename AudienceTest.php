class RouteAlterSubscriber extends RouteSubscriberBase {

  /**
   * {@inheritdoc}
   */
  protected function alterRoutes(RouteCollection $collection) {
    // Update permission on block content collection route.
    $route = $collection->get('entity.block_content.collection');
    if ($route) {
      // Remove any existing permission.
      $route->setRequirement([]);
      // Re-add only the administer block content permission.
      $route->setRequirements([
        '_permission' => 'administer block content',
      ]);
    }

  }

}
