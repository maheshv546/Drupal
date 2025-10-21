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
function voya_blocks_content_block_content_create_access(AccountInterface $account, array $context, $entity_bundle) {
  // Check 'create' permission for block content types.
  // Needed for inline form creation of block content (ex. Inline Entity Form).
  if ($account->hasPermission("create $entity_bundle block content")) {
    return AccessResult::allowed();
  }
  else {
    return AccessResult::forbidden();
  }
}
