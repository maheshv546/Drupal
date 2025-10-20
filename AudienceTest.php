<?php

declare(strict_types=1);

namespace Drupal\voya_blocks_content;

use Drupal\Core\Access\AccessResult;
use Drupal\Core\DependencyInjection\ContainerInjectionInterface;
use Drupal\Core\Entity\EntityTypeManagerInterface;
use Drupal\Core\Routing\RouteMatchInterface;
use Drupal\Core\Session\AccountInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Controller for the block content permissions.
 */
class AccessControlHandler implements ContainerInjectionInterface {

  /**
   * The entity type manager.
   */
  protected EntityTypeManagerInterface $entityTypeManager;

  /**
   * The current route match.
   */
  protected RouteMatchInterface $currentRouteMatch;

  /**
   * The current user.
   */
  protected AccountInterface $currentUser;

  /**
   * Cached block content type IDs.
   *
   * @var string[]
   */
  protected array $blockContentTypeIds = [];

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container): static {
    return new static(
      $container->get('entity_type.manager'),
      $container->get('current_route_match'),
      $container->get('current_user')
    );
  }

  /**
   * Constructs the access control handler.
   */
  public function __construct(
    EntityTypeManagerInterface $entity_type_manager,
    RouteMatchInterface $current_route_match,
    AccountInterface $current_user
  ) {
    $this->entityTypeManager = $entity_type_manager;
    $this->currentRouteMatch = $current_route_match;
    $this->currentUser = $current_user;
  }

  /**
   * Returns the block content type IDs.
   *
   * @return string[]
   *   The block content type IDs.
   */
  protected function blockContentTypes(): array {
    if (empty($this->blockContentTypeIds)) {
      $storage = $this->entityTypeManager->getStorage('block_content_type');
      $this->blockContentTypeIds = array_keys($storage->loadMultiple());
    }
    return $this->blockContentTypeIds;
  }

  /**
   * Access check for the block content type administer pages and forms.
   */
  public function blockContentTypeAdministerAccess(): AccessResult {
    return AccessResult::allowedIfHasPermission($this->currentUser, 'administer block content types');
  }

  /**
   * Access check for the block content add page.
   */
  public function blockContentAddPageAccess(): AccessResult {
    $permissions = [];
    foreach ($this->blockContentTypes() as $bundle_type) {
      $permissions[] = "create $bundle_type block content";
    }
    return AccessResult::allowedIfHasPermissions($this->currentUser, $permissions, 'OR');
  }

  /**
   * Access check for the block content add forms.
   */
  public function blockContentAddFormAccess(RouteMatchInterface $route_match): AccessResult {
    $block_content_type = $route_match->getParameter('block_content_type');
    if ($block_content_type && $block_content_type->id()) {
      return AccessResult::allowedIfHasPermission($this->currentUser, "create {$block_content_type->id()} block content");
    }
    return AccessResult::neutral();
  }

}