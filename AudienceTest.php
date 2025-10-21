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


FILE: ...ya_blocks/modules/voya_blocks_content/voya_blocks_content.module
----------------------------------------------------------------------
FOUND 2 ERRORS AFFECTING 1 LINE
----------------------------------------------------------------------
 16 | ERROR | Function
    |       | voya_blocks_content_block_content_create_access() does
    |       | not have parameter type hint nor @param annotation for
    |       | its parameter $entity_bundle.
    |       | (SlevomatCodingStandard.TypeHints.ParameterTypeHint.MissingAnyTypeHint)
 16 | ERROR | Function
    |       | voya_blocks_content_block_content_create_access() does
    |       | not have return type hint nor @return annotation for
    |       | its return value.
    |       | (SlevomatCodingStandard.TypeHints.ReturnTypeHint.MissingAnyTypeHint)
