<?php

declare(strict_types=1);

namespace Drupal\Tests\voya_core\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\redirect\Entity\Redirect;

/**
 * Tests redirect functionality.
 *
 * @group custom_module
 */
class RedirectTest extends BrowserTestBase {

  protected static $modules = ['node', 'redirect'];

  public function testRedirect(): void {
    $this->getSession()->getDriver()->getClient()->followRedirects(FALSE);

    // Create a node.
    $node = $this->createNode(['type' => 'article', 'title' => 'Test Node']);
    $canonical_path = '/node/' . $node->id();

    // Redirect from /old-path to the node.
    Redirect::create([
      'redirect_source' => ['path' => 'old-path'],
      'redirect_redirect' => ['uri' => 'internal:' . $canonical_path],
      'status_code' => 301,
    ])->save();

    // Visit source and assert redirect.
    $this->getSession()->visit('/old-path');
    $this->assertEquals(301, $this->getSession()->getStatusCode());

    $location = $this->getSession()->getResponseHeader('Location');
    $this->assertEquals($canonical_path, parse_url($location, PHP_URL_PATH));

    $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
  }

}