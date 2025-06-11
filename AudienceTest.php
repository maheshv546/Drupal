namespace Drupal\your_module\Plugin\Block;

use Drupal\Core\Block\BlockBase;
use Drupal\Core\Form\FormInterface;
use Drupal\Core\Form\FormStateInterface;

/**
 * Provides a 'Custom Form' Block.
 *
 * @Block(
 *   id = "custom_form_block",
 *   admin_label = @Translation("Custom Form Block")
 * )
 */
class CustomFormBlock extends BlockBase {

  public function build() {
    // Replace with your form class.
    return \Drupal::formBuilder()->getForm('Drupal\your_module\Form\CustomExampleForm');
  }

}