<?php

/**
 * @file
 * Voya Block content module.
 */

declare(strict_types=1);

use Drupal\Core\Access\AccessResult;
use Drupal\Core\Session\AccountInterface;

/**
 * Implements hook_ENTITY_TYPE_create_access().
 */
function voya_blocks_content_block_content_create_access(AccountInterface $account, array $context, ?string $entity_bundle): AccessResult {
  // Allow creation if the user has the specific bundle create permission.
  // Needed for inline form creation of block content (e.g., Inline Entity Form).
  if ($entity_bundle !== NULL && $account->hasPermission("create $entity_bundle block content")) {
    return AccessResult::allowed();
  }

  return AccessResult::forbidden();
}