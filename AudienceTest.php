<?php

declare(strict_types=1);

namespace Drupal\investor_type\Controller;

use Drupal\Core\Cache\CacheableMetadata;
use Drupal\Core\Controller\ControllerBase;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Set up variables for displaying calculator results.
 */
class InvestorTypeResultsController extends ControllerBase {

  /**
   * Class constructor.
   *
   * @param \Symfony\Component\HttpFoundation\RequestStack $request
   *   Request stack.
   */
  public function __construct(protected RequestStack $request) {}

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container) {
    // Instantiates this form class.
    return new static(
      // Load the service required to construct this class.
      $container->get('request_stack')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function getLegalText() {
    $config = $this->config('investor_type.settings');
    $legal_text['portfolio_details'] = $config->get("portfolio_details");
    $legal_text['calulator'] = $config->get("calculator_disclaimer");
    $legal_text['privacy'] = $config->get("privacy_disclaimer");
    $legal_text['securities'] = $config->get("securities_disclaimer");
    $legal_text['compliance'] = $config->get("compliance_disclaimer");
    $legal_text['risk_levels'] = $config->get("risk_levels_disclaimer");

    return $legal_text;
  }

  /**
   * {@inheritdoc}
   */
  public function getRiskLevels() {
    $config = $this->config('investor_type.settings');
    $risk_level_names = [
      'conservative',
      'moderately_conservative',
      'moderate',
      'moderately_aggressive',
      'aggressive',
    ];

    foreach ($risk_level_names as $name) {
      $risk_levels[$name]['suitability'] = $config->get($name . "_suitability");
      $risk_levels[$name]['asset_classes'] = $this->getAssetClasses($name);
    }

    $risk_levels['overview'] = $config->get('risk_levels_overview');

    for ($i = 1; $i <= 8; $i++) {
      $risk_levels['asset_class_key']['asset_class_' . $i]['name'] = $config->get('asset_class_key_ac_' . $i . '_name');
      $risk_levels['asset_class_key']['asset_class_' . $i]['color'] = $config->get('asset_class_key_ac_' . $i . '_color');
    }

    return $risk_levels;
  }

  /**
   * {@inheritdoc}
   */
  public function getAssetClasses($investor_type) {
    $config = $this->config('investor_type.settings');
    $asset_class_1_name = strtolower($investor_type . "_ac_1_name");
    $asset_class_1_percentage = strtolower($investor_type . "_ac_1_percentage");
    $asset_class_1_color = strtolower($investor_type . "_ac_1_color");
    $asset_class_1_description = strtolower($investor_type . "_ac_1_description");
    $asset_class_2_name = strtolower($investor_type . "_ac_2_name");
    $asset_class_2_percentage = strtolower($investor_type . "_ac_2_percentage");
    $asset_class_2_color = strtolower($investor_type . "_ac_2_color");
    $asset_class_2_description = strtolower($investor_type . "_ac_2_description");
    $asset_class_3_name = strtolower($investor_type . "_ac_3_name");
    $asset_class_3_percentage = strtolower($investor_type . "_ac_3_percentage");
    $asset_class_3_color = strtolower($investor_type . "_ac_3_color");
    $asset_class_3_description = strtolower($investor_type . "_ac_3_description");
    $asset_class_4_name = strtolower($investor_type . "_ac_4_name");
    $asset_class_4_percentage = strtolower($investor_type . "_ac_4_percentage");
    $asset_class_4_color = strtolower($investor_type . "_ac_4_color");
    $asset_class_4_description = strtolower($investor_type . "_ac_4_description");
    $asset_class_5_name = strtolower($investor_type . "_ac_5_name");
    $asset_class_5_percentage = strtolower($investor_type . "_ac_5_percentage");
    $asset_class_5_color = strtolower($investor_type . "_ac_5_color");
    $asset_class_5_description = strtolower($investor_type . "_ac_5_description");
    $asset_class_6_name = strtolower($investor_type . "_ac_6_name");
    $asset_class_6_percentage = strtolower($investor_type . "_ac_6_percentage");
    $asset_class_6_color = strtolower($investor_type . "_ac_6_color");
    $asset_class_6_description = strtolower($investor_type . "_ac_6_description");
    $asset_class_7_name = strtolower($investor_type . "_ac_7_name");
    $asset_class_7_percentage = strtolower($investor_type . "_ac_7_percentage");
    $asset_class_7_color = strtolower($investor_type . "_ac_7_color");
    $asset_class_7_description = strtolower($investor_type . "_ac_7_description");
    $asset_class_8_name = strtolower($investor_type . "_ac_8_name");
    $asset_class_8_percentage = strtolower($investor_type . "_ac_8_percentage");
    $asset_class_8_color = strtolower($investor_type . "_ac_8_color");
    $asset_class_8_description = strtolower($investor_type . "_ac_8_description");
    $asset_classes['ac1']['name'] = $config->get($asset_class_1_name);
    $asset_classes['ac1']['percentage'] = $config->get($asset_class_1_percentage);
    $asset_classes['ac1']['color'] = $config->get($asset_class_1_color);
    $asset_classes['ac1']['key'] = str_replace(" ", "_", $config->get($asset_class_1_name));
    $asset_classes['ac1']['description'] = $config->get($asset_class_1_description);
    $asset_classes['ac2']['name'] = $config->get($asset_class_2_name);
    $asset_classes['ac2']['percentage'] = $config->get($asset_class_2_percentage);
    $asset_classes['ac2']['color'] = $config->get($asset_class_2_color);
    $asset_classes['ac2']['key'] = str_replace(" ", "_", $config->get($asset_class_2_name));
    $asset_classes['ac2']['description'] = $config->get($asset_class_2_description);
    $asset_classes['ac3']['name'] = $config->get($asset_class_3_name);
    $asset_classes['ac3']['percentage'] = $config->get($asset_class_3_percentage);
    $asset_classes['ac3']['color'] = $config->get($asset_class_3_color);
    $asset_classes['ac3']['key'] = str_replace(" ", "_", $config->get($asset_class_3_name));
    $asset_classes['ac3']['description'] = $config->get($asset_class_3_description);
    $asset_classes['ac4']['name'] = $config->get($asset_class_4_name);
    $asset_classes['ac4']['percentage'] = $config->get($asset_class_4_percentage);
    $asset_classes['ac4']['color'] = $config->get($asset_class_4_color);
    $asset_classes['ac4']['key'] = str_replace(" ", "_", $config->get($asset_class_4_name));
    $asset_classes['ac4']['description'] = $config->get($asset_class_4_description);
    $asset_classes['ac5']['name'] = $config->get($asset_class_5_name);
    $asset_classes['ac5']['percentage'] = $config->get($asset_class_5_percentage);
    $asset_classes['ac5']['color'] = $config->get($asset_class_5_color);
    $asset_classes['ac5']['key'] = str_replace(" ", "_", $config->get($asset_class_5_name));
    $asset_classes['ac5']['description'] = $config->get($asset_class_5_description);
    $asset_classes['ac6']['name'] = $config->get($asset_class_6_name);
    $asset_classes['ac6']['percentage'] = $config->get($asset_class_6_percentage);
    $asset_classes['ac6']['color'] = $config->get($asset_class_6_color);
    $asset_classes['ac6']['key'] = str_replace(" ", "_", $config->get($asset_class_6_name));
    $asset_classes['ac6']['description'] = $config->get($asset_class_6_description);
    $asset_classes['ac7']['name'] = $config->get($asset_class_7_name);
    $asset_classes['ac7']['percentage'] = $config->get($asset_class_7_percentage);
    $asset_classes['ac7']['color'] = $config->get($asset_class_7_color);
    $asset_classes['ac7']['key'] = str_replace(" ", "_", $config->get($asset_class_7_name));
    $asset_classes['ac7']['description'] = $config->get($asset_class_7_description);
    $asset_classes['ac8']['name'] = $config->get($asset_class_8_name);
    $asset_classes['ac8']['percentage'] = $config->get($asset_class_8_percentage);
    $asset_classes['ac8']['color'] = $config->get($asset_class_8_color);
    $asset_classes['ac8']['key'] = str_replace(" ", "_", $config->get($asset_class_8_name));
    $asset_classes['ac8']['description'] = $config->get($asset_class_8_description);
    return $asset_classes;
  }

  /**
   * {@inheritdoc}
   */
  public function resultsPage() {
    // Ensure to include cacheability for request param we are using!
    $cache = new CacheableMetadata();
    $cache->setCacheContexts(['url.query_args:type']);
    $type = strtolower($this->request->getCurrentRequest()->get('type'));
    $asset_classes = $this->getAssetClasses(str_replace(" ", "_", $type));
    $risk_levels = $this->getRiskLevels();
    $legal_text = $this->getLegalText();
    $results_page = [
      '#investor_type' => $type,
      '#investor_type_key' => str_replace(" ", "_", $type),
      '#asset_classes' => $asset_classes,
      '#risk_levels' => $risk_levels,
      '#legal_text' => $legal_text,
      '#theme' => 'investor_type_results',
    ];
    $cache->applyTo($results_page);
    return $results_page;
  }

}

