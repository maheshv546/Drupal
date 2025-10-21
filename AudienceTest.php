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
 *
 * @param \Drupal\Core\Session\AccountInterface $account
 *   The user account to check access for.
 * @param array $context
 *   The context of the access check.
 * @param string|null $entity_bundle
 *   The bundle of the block content entity, if known.
 *
 * @return \Drupal\Core\Access\AccessResult
 *   The access result indicating if creation is allowed.
 */
function voya_blocks_content_block_content_create_access(AccountInterface $account, array $context, ?string $entity_bundle): AccessResult {
  // Check 'create' permission for block content types.
  // Needed for inline form creation of block content (e.g., Inline Entity Form).
  if ($entity_bundle !== NULL && $account->hasPermission("create $entity_bundle block content")) {
    return AccessResult::allowed();
  }

  return AccessResult::forbidden();
}
