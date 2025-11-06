<?php

declare(strict_types=1);

namespace Drupal\voya_search\Service;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\search_api\Entity\Index;
use Drupal\search_api\IndexBatchHelper;
use Drupal\search_api\Utility\FieldsHelperInterface;

/**
 * Class SearchApiUtility.
 *
 * Helper for our SAPI implementation.
 */
class SearchApiUtility {
  use MessengerTrait;

  /**
   * SearchApiUtility constructor.
   *
   * @param \Drupal\search_api\Utility\FieldsHelperInterface $fieldsHelper
   *   Search API fields helper.
   */
  public function __construct(protected FieldsHelperInterface $fieldsHelper) {}

  /**
   * Add fields to an index.
   *
   * @param array $fields
   *   Array with keys: 'label', 'property_path' and 'type'.
   * @param string $index
   *   Index id.
   * @param string $datasource_id
   *   Datasource id.
   */
  public function addFieldsToIndex(array $fields, string $index = 'content', string $datasource_id = 'entity:node'): void {
    $index = Index::load($index);
    if ($index) {
      foreach ($fields as $key => $info) {
        $info += ['datasource_id' => $datasource_id];
        $field = $this->fieldsHelper->createField($index, $key, $info);
        // Ensure we don't overwrite an existing field.
        if (is_null($index->getField($key))) {
          $index->addField($field);
        }
      }
      $index->save();
    }
  }

  /**
   * Rebuild the search index.
   *
   * @param array $sandbox
   *   The batch processor.
   * @param string $index_id
   *   Search API index id.
   */
  public function reindexSearchApi(array &$sandbox, string $index_id = 'content'): void {
    $index = Index::load($index_id);
    // Clear the index in the first batch run.
    if (!isset($sandbox['status'])) {
      $index->clear();
      $sandbox['status'] = 'reset';
    }

    // Index all items in batches of 250.
    // This takes the $sandbox param as $context.
    IndexBatchHelper::process($index, 250, -1, -1, $sandbox);

    // Helper format isn't QUITE right, so adjust.
    $sandbox['#finished'] = $sandbox['finished'];

    // Let CLI know when finished.
    if ($sandbox['#finished'] === 1 && isset($sandbox['message'])) {
      $this->messenger()->addStatus($sandbox['message']);
    }
  }

}


Call to method process() of deprecated class                                  
         Drupal\search_api\IndexBatchHelper:                                           
         in search_api:8.x-1.40 and is removed from search_api:2.0.0. Use              
           the "search_api.indexing_batch_helper" service instead.                     
         🪪  staticMethod.deprecatedClass 
