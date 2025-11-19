<?php

declare(strict_types=1);

namespace Drupal\voya_site_resourcecenter\Plugin\EntityBrowser\Widget;

use Drupal\Core\Form\FormStateInterface;
use Drupal\Core\Plugin\ContainerFactoryPluginInterface;
use Drupal\file\FileValidatorInterface;
use Drupal\file\Plugin\Field\FieldType\FileItem;
use Drupal\image\Plugin\Field\FieldType\ImageItem;
use Drupal\media\MediaInterface;
use Drupal\media\MediaTypeInterface;
use Drupal\voya_site_resourcecenter\Element\AjaxUpload;
use Drupal\voya_site_resourcecenter\MediaHelper;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * An Entity Browser widget for creating media entities from uploaded files.
 */
class FileUpload extends EntityFormProxy implements ContainerFactoryPluginInterface {

  /**
   * The file validator service.
   *
   * @var \Drupal\file\FileValidatorInterface
   */
  protected FileValidatorInterface $fileValidator;

  /**
   * {@inheritdoc}
   */
  public function __construct(
    array $configuration,
    $plugin_id,
    $plugin_definition,
    FileValidatorInterface $file_validator,
  ) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);
    $this->fileValidator = $file_validator;
  }

  /**
   * {@inheritdoc}
   */
  public static function create(ContainerInterface $container, array $configuration, $plugin_id, $plugin_definition) {
    return new static(
      $configuration,
      $plugin_id,
      $plugin_definition,
      $container->get('file.validator')
    );
  }

  /**
   * {@inheritdoc}
   */
  protected function getCurrentValue(FormStateInterface $form_state): mixed {
    $value = parent::getCurrentValue($form_state);
    return $value['fid'] ?? NULL;
  }

  /**
   * {@inheritdoc}
   */
  protected function prepareEntities(array $form, FormStateInterface $form_state) {
    $entities = parent::prepareEntities($form, $form_state);

    $get_file = function (MediaInterface $entity) {
      return MediaHelper::getSourceField($entity)->entity;
    };

    return $this->configuration['return_file']
      ? array_map($get_file, $entities)
      : $entities;
  }

  /**
   * {@inheritdoc}
   */
  public function getForm(array &$original_form, FormStateInterface $form_state, array $additional_widget_parameters) {
    $form = parent::getForm($original_form, $form_state, $additional_widget_parameters);

    $form['input'] = [
      '#type' => 'ajax_upload',
      '#title' => $this->t('File'),
      '#required' => TRUE,
      '#process' => [
        [$this, 'processUploadElement'],
      ],
      '#upload_validators' => $this->getUploadValidators(),
      '#weight' => 70,
    ];

    return $form;
  }

  /**
   * Returns all applicable upload validators.
   */
  protected function getUploadValidators(): array {
    $validators = $this->configuration['upload_validators'];

    if (empty($validators['file_validate_extensions'])) {
      return array_merge([
        'file_validate_extensions' => [
          implode(' ', $this->getAllowedFileExtensions()),
        ],
      ], $validators);
    }

    return $validators;
  }

  /**
   * Returns all file extensions accepted by allowed media types.
   */
  protected function getAllowedFileExtensions(): array {
    $extensions = '';

    foreach ($this->getAllowedTypes() as $media_type) {
      $extensions .= $media_type->getSource()
        ->getSourceFieldDefinition($media_type)
        ->getSetting('file_extensions') . ' ';
    }

    $extensions = preg_split('/,?\s+/', rtrim($extensions));
    return array_unique($extensions);
  }

  /**
   * {@inheritdoc}
   */
  public function validate(array &$form, FormStateInterface $form_state) {
    $fid = $this->getCurrentValue($form_state);
    if ($fid) {
      parent::validate($form, $form_state);

      $media = $this->getCurrentEntity($form_state);
      if ($media) {
        foreach ($this->validateFile($media) as $error) {
          $form_state->setError($form['widget']['input'], $error);
        }
      }
    }
  }

  /**
   * Validates the file entity associated with a media item (Drupal 11).
   */
  protected function validateFile(MediaInterface $media): array {
    $field = $media->getSource()
      ->getSourceFieldDefinition($media->get('bundle')->entity)
      ->getName();

    /** @var \Drupal\file\Plugin\Field\FieldType\FileItem $item */
    $item = $media->get($field)->first();

    $validators = [
      'file_validate_name_length' => [],
    ];
    $validators = array_merge($validators, $item->getUploadValidators());

    // Already validated elsewhere.
    unset($validators['file_validate_extensions']);

    // Add image validators if this is an image field.
    if ($item instanceof ImageItem) {
      $validators['file_validate_is_image'] = [];

      $settings = $item->getFieldDefinition()->getSettings();
      if ($settings['max_resolution'] || $settings['min_resolution']) {
        $validators['file_validate_image_resolution'] = [
          $settings['max_resolution'],
          $settings['min_resolution'],
        ];
      }
    }

    // ✔ Drupal 11: Use injected service instead of file_validate().
    return $this->fileValidator->validate($item->entity, $validators);
  }

  /**
   * {@inheritdoc}
   */
  public function submit(array &$element, array &$form, FormStateInterface $form_state) {
    /** @var \Drupal\media\MediaInterface $entity */
    $entity = $element['entity']['#entity'];

    $file = MediaHelper::useFile(
      $entity,
      MediaHelper::getSourceField($entity)->entity
    );

    $file->setPermanent();
    $file->save();
    $entity->save();

    $selection = [
      $this->configuration['return_file'] ? $file : $entity,
    ];
    $this->selectEntities($selection, $form_state);
  }

  /**
   * Processes the upload element.
   */
  public function processUploadElement(array $element, FormStateInterface $form_state): array {
    $element = AjaxUpload::process($element, $form_state);

    $element['upload_button']['#ajax']['callback'] =
    $element['remove']['#ajax']['callback'] = [static::class, 'ajax'];

    $element['remove']['#value'] = $this->t('Cancel');

    return $element;
  }

  /**
   * {@inheritdoc}
   */
  public function defaultConfiguration() {
    $configuration = parent::defaultConfiguration();
    $configuration['return_file'] = FALSE;
    $configuration['upload_validators'] = [];
    return $configuration;
  }

  /**
   * {@inheritdoc}
   */
  public function buildConfigurationForm(array $form, FormStateInterface $form_state) {
    $form = parent::buildConfigurationForm($form, $form_state);

    $form['return_file'] = [
      '#type' => 'checkbox',
      '#title' => $this->t('Return source file entity'),
      '#default_value' => $this->configuration['return_file'],
      '#description' => $this->t('If checked, the source file(s) of the media entity will be returned.'),
    ];
    return $form;
  }

  /**
   * {@inheritdoc}
   */
  protected function isAllowedType(MediaTypeInterface $media_type): bool {
    $is_allowed = parent::isAllowedType($media_type);

    if ($is_allowed) {
      $item_class = $media_type->getSource()
        ->getSourceFieldDefinition($media_type)
        ->getItemDefinition()
        ->getClass();

      $is_allowed = is_a($item_class, FileItem::class, TRUE);
    }

    return $is_allowed;
  }

}