<?php

declare(strict_types=1);

namespace Drupal\Tests\voya_standard\Functional;

use Drupal\Core\Url;
use Drupal\node\NodeInterface;
use Drupal\Tests\BrowserTestBase;
use Voya\Drupal\Tests\VoyaTestTrait;
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
    'voya_standard',
  ];

  /**
   * Checking redirect functionality.
   */
  public function testCheckRedirect(): void {
    // Disable automatic redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(FALSE);

    $this->node1 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article test 1',
      'status' => NodeInterface::PUBLISHED,
      'moderation_state' => 'published',
      'field_post_date' => '2021-12-31T12:00:00',
    ]);
    $this->node2 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article test 2',
      'status' => NodeInterface::PUBLISHED,
      'field_post_date' => '2022-03-31T12:00:00',
      'moderation_state' => 'published',
    ]);
    $this->node3 = $this->drupalCreateNode([
      'type' => 'article',
      'title' => 'Article test 3',
      'status' => NodeInterface::PUBLISHED,
      'moderation_state' => 'published',
      'field_post_date' => '2020-08-31T12:00:00',
    ]);

    $redirect_from_url = '/article/article-test-1';
    $redirect_to_url = '/article/article-test-2';

    // Create redirect.
    Redirect::create([
      'redirect_source' => ['path' => $redirect_from_url],
      'redirect_redirect' => ['uri' => 'internal:' . $redirect_to_url],
      'language' => 'en',
      'status_code' => 301,
    ])->save();

    // Visit the redirect source URL.
    $this->getSession()->visit(Url::fromUserInput($redirect_from_url)->toString());

    // Assert the redirect location matches the target URL.
    $this->assertEquals($redirect_to_url, parse_url($this->getSession()->getResponseHeader('Location'), PHP_URL_PATH));

    // Reset redirect following.
    $this->getSession()->getDriver()->getClient()->followRedirects(TRUE);
  }

}
