<?php

declare(strict_types=1);

namespace Drupal\Tests\investor_type\Functional;

use Drupal\Tests\BrowserTestBase;

/**
 * Tests redirects for investor_type.results route.
 *
 * @group investor_type
 */
final class InvestorTypeRedirectTest extends BrowserTestBase {

  /**
   * {@inheritdoc}
   */
  protected static $modules = [
    'investor_type',
    'node', // Add dependencies your module needs.
  ];

  /**
   * Tests redirect when ?type is missing.
   */
  public function testRedirectWhenTypeMissing(): void {
    // Go to investor_type.results without query parameter.
    $this->drupalGet('/investor-type/results'); // Adjust to your route path.

    // Should redirect to investor_type.content.
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->addressEquals('/investor-type/content'); // Adjust to route path.
  }

  /**
   * Tests no redirect when ?type is present.
   */
  public function testNoRedirectWhenTypePresent(): void {
    $this->drupalGet('/investor-type/results', ['query' => ['type' => 'abc']]);

    // Should NOT redirect, should stay on results.
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->addressEquals('/investor-type/results?type=abc');
    $this->assertSession()->pageTextContains('Investor Type Results'); // Example text.
  }

}