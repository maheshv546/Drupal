<?php

declare(strict_types=1);

namespace Drupal\voya_search\Service;

use Drupal\Core\Messenger\MessengerTrait;
use Drupal\search_api\Entity\Index;
use Drupal\search_api\Utility\FieldsHelperInterface;
use Drupal\search_api\Utility\IndexingBatchHelperInterface;

/**
 * Class SearchApiUtility.
 *
 * Helper for our SAPI implementation.
 */
final class SearchApiUtility {
  use MessengerTrait;

  /**
   * SearchApiUtility constructor.
   *
   * @param \Drupal\search_api\Utility\FieldsHelperInterface $fieldsHelper
   *   Search API fields helper.
   * @param \Drupal\search_api\Utility\IndexingBatchHelperInterface $batchHelper
   *   Search API indexing batch helper.
   */
  public function __construct(
    protected FieldsHelperInterface $fieldsHelper,
    protected IndexingBatchHelperInterface $batchHelper,
  ) {}

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
        if ($index->getField($key) === NULL) {
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
    if (!$index) {
      return;
    }

    // Clear the index on the first run.
    if (!isset($sandbox['status'])) {
      $index->clear();
      $sandbox['status'] = 'reset';
    }

    // Use the injected batch helper service.
    $this->batchHelper->process($index, 250, -1, -1, $sandbox);

    // Adjust the finished flag for batch API.
    $sandbox['#finished'] = $sandbox['finished'] ?? 1;

    if ($sandbox['#finished'] === 1 && isset($sandbox['message'])) {
      $this->messenger()->addStatus($sandbox['message']);
    }
  }

}