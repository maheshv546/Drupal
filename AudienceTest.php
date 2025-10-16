/**
 * Implements hook_entity_type_alter().
 */
function my_module_entity_type_alter(array &$entity_types): void {
  if (isset($entity_types['block_content'])) {
    $entity_types['block_content']->setHandlerClass('access', \Drupal\my_module\Access\CustomBlockContentAccessControlHandler::class);
  }
}