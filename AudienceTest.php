<?php

declare(strict_types=1);

namespace Drupal\Tests\voya_core\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;
use Voya\Drupal\Tests\VoyaTestTrait;
use Drupal\path_alias\Entity\PathAlias;
use Drupal\redirect\Entity\Redirect;

/**
 * Tests checking Redirect.
 *
 * @group custom_module
 */
class RedirectTest extends BrowserTestBase {
  use VoyaTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'voya_core',
    'node',
    'path',
    'redirect',
  ];

  /**
   * Tests redirect functionality.
   */
  public function testCheckRedirect(): void {

    // Disable automatic redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(FALSE);

    // Create a node programmatically.
    $node = $this->createNode([
      'type' => 'article',
      'title' => 'Test Node',
    ]);

    // Generate the canonical path and alias.
    $canonical_path = '/node/' . $node->id();
    $alias = '/node/6';

   // Create and save the alias using the PathAlias entity.
   PathAlias::create([
    'path' => $canonical_path,
    'alias' => $alias,
    'langcode' => 'en',
  ])->save();

    // Create and save the redirect using the Redirect entity.
    Redirect::create([
      'redirect_source' => [
        'path' => ltrim($alias, '/'),
        'query' => [],
      ],
      'redirect_redirect' => [
        'uri' => 'internal:' . $canonical_path,
      ],
      'language' => 'en',
      'status_code' => 301,
    ])->save();

    // Visit the alias and check the redirect.
    $this->getSession()->visit(Url::fromUserInput($alias)->toString());
    $redirect_location = $this->getSession()->getResponseHeader('Location');
    $this->assertNotNull($redirect_location, 'Redirect location is not null.');

    // Assert that the redirect location matches the expected canonical path.
    $this->assertEquals($canonical_path, $redirect_location);

    // Reset redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
  }

}

