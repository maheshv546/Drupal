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
    'redirect',
  ];

  /**
   * Tests redirect functionality.
   */
  public function testCheckRedirect(): void {
    // Disable automatic redirect following so we can inspect headers.
    $this->getSession()->getDriver()->getClient()->followRedirects(FALSE);

    // Create a node programmatically.
    $node = $this->createNode([
      'type' => 'article',
      'title' => 'Test Node',
    ]);

    $canonical_path = '/node/' . $node->id();
    $alias = '/test-alias';

    // Create and save the alias.
    PathAlias::create([
      'path' => $canonical_path,
      'alias' => $alias,
      'langcode' => 'en',
    ])->save();

    // Create and save the redirect.
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

    // Visit the alias.
    $this->getSession()->visit(Url::fromUserInput($alias)->toString());

    // Assert status code is 301.
    $status_code = $this->getSession()->getStatusCode();
    $this->assertEquals(301, $status_code, 'Redirect response returned 301.');

    // Get Location header directly from Guzzle response.
    $response = $this->getSession()->getDriver()->getClient()->getResponse();
    $headers = $response->getHeaders();
    $this->assertArrayHasKey('Location', $headers, 'Response has a Location header.');
    $redirect_location = $headers['Location'][0];

    // Assert the Location header matches canonical path.
    $this->assertEquals($canonical_path, $redirect_location);

    // (Optional) Follow the redirect manually and assert the final page loads.
    $this->getSession()->visit($redirect_location);
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->pageTextContains('Test Node');

    // Reset redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
  }

}