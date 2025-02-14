<?php

namespace Drupal\Tests\your_module\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Entity\Term;

/**
 * Tests if the existing Audience vocabulary and terms exist.
 *
 * @group your_module
 */
class ExistingAudienceVocabularyTest extends KernelTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['taxonomy'];

  /**
   * Tests the existing Audience vocabulary and its terms.
   */
  public function testExistingAudienceVocabularyAndTerms() {
    // Ensure the 'taxonomy' module is installed.
    $this->assertTrue(\Drupal::moduleHandler()->moduleExists('taxonomy'));

    // Check if the 'Audience' vocabulary exists.
    $vocabulary = Vocabulary::load('audience');
    $this->assertNotNull($vocabulary, 'The Audience vocabulary exists.');

    // Define the expected term names.
    $expected_terms = ['Students', 'Teachers', 'Parents'];

    // Check if each term exists in the 'Audience' vocabulary.
    foreach ($expected_terms as $term_name) {
      $terms = \Drupal::entityTypeManager()->getStorage('taxonomy_term')->loadByProperties([
        'vid' => 'audience',
        'name' => $term_name,
      ]);
      $this->assertNotEmpty($terms, "The term '$term_name' exists in the Audience vocabulary.");
    }
  }
}