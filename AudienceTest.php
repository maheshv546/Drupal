<?php

declare(strict_types=1);

namespace Drupal\Tests\voya_security\Functional;

use Drupal\Tests\BrowserTestBase;
use Drupal\user\Entity\User;
use Drupal\voya_security\SecurityModule;
use Voya\Drupal\Tests\VoyaTestTrait;

/**
 * Functional tests of the voya_security module.
 *
 * @group voya_security
 */
class SecurityTest extends BrowserTestBase {
  use VoyaTestTrait;

  /**
   * {@inheritdoc}
   */
  protected static $modules = ['voya_security'];

  /**
   * Run voya_security functional tests with a single install to save time.
   */
  public function testSecurity(): void {
    $this->runAutocompleteTest();
    $this->runRolesPermissionsTweaksTest();
    $this->runSsoTest();
    $this->runMaintenanceModeTest();
    $this->runPasswordResetPageTest();
    // Run last b/c this installs another module.
    $this->runPermissionsTest();
  }

  /**
   * Ensure username/password fields have autocomplete off on them.
   *
   * @covers ::voya_security_form_user_login_form_alter
   */
  protected function runAutocompleteTest(): void {
    // As an anonymous user, get the login page.
    $this->drupalGet('/user');
    // Ensure that the username/password field have autocomplete=off.
    $this->assertSession()->elementExists('xpath', '//input[@name="name" and @autocomplete="off"]');
    $this->assertSession()->elementExists('xpath', '//input[@name="pass" and @autocomplete="off"]');
  }

  /**
   * Ensure users with "administer roles" can add roles to new users.
   *
   * @covers ::voya_security_form_user_register_form_alter
   */
  protected function runRolesPermissionsTweaksTest(): void {
    $this->drupalLogin($this->drupalCreateUser(['administer users']));

    // Make sure I can see roles here, and I can give them to a user.
    $this->drupalGet('admin/people/create');
    $this->assertSession()->elementTextContains('xpath', '//fieldset[@data-drupal-selector="edit-roles"]/legend', 'Roles');
    // Do the same for the user edit form.
    $this->drupalGet('user/1/edit');
    $this->assertSession()->elementTextContains('xpath', '//fieldset[@data-drupal-selector="edit-roles"]/legend', 'Roles');

    $this->drupalLogout();
  }

  /**
   * Ensure the site_builder permissions are in place as expected.
   */
  protected function runPermissionsTest(): void {
    // Install the block module to test the permissions.
    $this->container->get('module_installer')->install(['voya_core','system']);

    $this->drupalLogin($this->personaSiteOwner());

    // Ensure user cannot get to the block admin page.
    $this->drupalGet('admin/structure/block');
    $this->assertSession()->statusCodeEquals(403);

    // Ensure user can get to the reports page.
    $this->drupalGet('admin/reports');
    $this->assertSession()->statusCodeEquals(200);

    // Ensure a user can edit a block provided by voya_core, for example.
    $block = $this->drupalPlaceBlock('voya_header');
    $this->drupalGet('admin/structure/block/manage/' . $block->id());
    // @todo I don't believe this test is working correctly.
    // User gets access b/c of "administer blocks" permission.
    $this->assertSession()->statusCodeEquals(200);

    $this->drupalLogout();
  }

  /**
   * Test configuration related to SSO.
   */
  protected function runSsoTest(): void {
    // Check if the SimpleSAMLphp auth link is shown on the login form.
    $this->drupalGet('user/login');
    $this->assertSession()->pageTextContains('Voya employee login');
    $this->clickLink('Voya employee login');

    /*
     * Our default local test user should be an admin.
     *
     * @see src/Drupal/simplesamlphp/config/authsources.php
     */
    $john_doe = User::load(3);
    $this->assertTrue($john_doe->hasRole('administrator'));
    $this->assertTrue($john_doe->hasRole('employee'));
    // Check if there's a cookie set after a user logs in.
    $this->assertEquals(TRUE, $this->getSession()->getCookie(SecurityModule::COOKIE_NAME_AUTHENTICATED));
    $this->drupalGet('/user/');
    $this->assertSession()->addressEquals('/user/3');
    // Make sure the SAML attributes are mapped appropriately to the fields.
    $this->assertEquals("John Doe", $john_doe->field_full_name->value);

    $this->drupalLogout();
  }

  /**
   * Check if a contributor can log in while maintenance mode is enabled.
   */
  protected function runMaintenanceModeTest(): void {
    // Set site into maintenance mode.
    \Drupal::state()->set('system.maintenance_mode', TRUE);

    // Log in as a contributor.
    $user = $this->drupalCreateUser();
    $user->addRole('contributor');
    $user->save();
    $this->drupalLogin($user);

    // Make sure we can access the site while in maintenance mode.
    $this->drupalGet('admin/content');
    $this->assertSession()->statusCodeEquals(200);
    $this->assertSession()->pageTextNotContains('Drupal is currently under maintenance. We should be back shortly. Thank you for your patience.');

    // Turn off maintenance mode (so other tests can run).
    \Drupal::state()->set('system.maintenance_mode', FALSE);

    $this->drupalLogout();
  }

  /**
   * Test custom Voya password reset controller.
   */
  protected function runPasswordResetPageTest(): void {
    $timestamp = $this->container->get('datetime.time')->getRequestTime() - 1;
    $account = $this->drupalCreateUser();
    $this->drupalGet("user/reset/" . $account->id() . "/$timestamp/" . user_pass_rehash($account, $timestamp) . '/login');
    $this->assertSession()->pageTextContains("You have used a one-time login link. You can set your new password now.");
    $this->drupalLogout();
    // @todo Add a test for the User1/Prod email functionality.
  }

}
