<?php

declare(strict_types=1);

namespace Drupal\Tests\your_module\Kernel;

use Drupal\KernelTests\KernelTestBase;
use Drupal\taxonomy\Entity\Vocabulary;
use Drupal\taxonomy\Entity\Term;

/**
 * Tests that the Audience vocabulary and specific terms exist.
 *
 * @group your_module
 */
class AudienceVocabularyTest extends KernelTestBase {

  /**
   * The modules to enable.
   *
   * @var string[]
   */
  protected static $modules = [
    'taxonomy',
    'user',
    'your_module',
  ];

  /**
   * Sample terms to check.
   *
   * @var string[]
   */
  protected array $expectedTerms = [
    'General Public',
    'Students',
    'Professionals',
  ];

  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('taxonomy_term');
    $this->installEntitySchema('taxonomy_vocabulary');

    // Create the vocabulary if it does not exist.
    if (!Vocabulary::load('audience')) {
      Vocabulary::create([
        'vid' => 'audience',
        'name' => 'Audience',
      ])->save();
    }

    $termStorage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');

    // Create terms if they do not already exist.
    foreach ($this->expectedTerms as $termName) {
      $existingTerms = $termStorage->loadByProperties([
        'vid' => 'audience',
        'name' => $termName,
      ]);
      if (!$existingTerms) {
        Term::create([
          'vid' => 'audience',
          'name' => $termName,
        ])->save();
      }
    }
  }

  public function testAudienceVocabularyExists(): void {
    $vocabulary = Vocabulary::load('audience');
    $this->assertNotNull($vocabulary, 'Audience vocabulary exists.');
  }

  public function testSpecificAudienceTermsExist(): void {
    $termStorage = \Drupal::entityTypeManager()->getStorage('taxonomy_term');
    foreach ($this->expectedTerms as $termName) {
      $terms = $termStorage->loadByProperties([
        'vid' => 'audience',
        'name' => $termName,
      ]);
      $this->assertNotEmpty($terms, "Term '{$termName}' exists in Audience vocabulary.");
    }
  }
}