<?php

declare(strict_types=1);

namespace Drupal\Tests\voya_core\Functional;

use Drupal\Core\Url;
use Drupal\Tests\BrowserTestBase;
use Voya\Drupal\Tests\VoyaTestTrait;
use Drupal\path_alias\Entity\PathAlias;
use Drupal\redirect\Entity\Redirect;

/**
 * Tests redirect functionality.
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
    'path_alias',
    'redirect',
  ];

  /**
   * {@inheritdoc}
   */
  protected function setUp(): void {
    parent::setUp();
    $this->installEntitySchema('node');
    $this->installEntitySchema('path_alias');
    $this->installEntitySchema('redirect');
    $this->installConfig(['redirect']);
  }

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

    $canonical_path = '/node/' . $node->id();
    $alias = '/test-alias';

    // Create alias.
    PathAlias::create([
      'path' => $canonical_path,
      'alias' => $alias,
      'langcode' => 'en',
    ])->save();

    // Create redirect.
    Redirect::create([
      'redirect_source' => ['path' => ltrim($alias, '/')],
      'redirect_redirect' => ['uri' => 'internal:' . $canonical_path],
      'language' => 'en',
      'status_code' => 301,
    ])->save();

    // Visit alias.
    $this->getSession()->visit(Url::fromUserInput($alias)->toString());

    // Assert status code is 301.
    $this->assertEquals(301, $this->getSession()->getStatusCode());

    // Get Location header.
    $response = $this->getSession()->getDriver()->getClient()->getResponse();
    $headers = $response->getHeaders();
    $this->assertArrayHasKey('Location', $headers, 'Response has a Location header.');
    $redirect_location = $headers['Location'][0];

    // Assert redirect points to canonical path.
    $this->assertEquals($canonical_path, $redirect_location);

    // Reset redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
  }

}