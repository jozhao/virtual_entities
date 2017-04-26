<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\virtual_entities\VirtualEntityInterface;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;

/**
 * Defines the virtual entity class.
 *
 * @ContentEntityType(
 *   id = "virtual_entity",
 *   label = @Translation("Virtual entity"),
 *   bundle_label = @Translation("Virtual entity type"),
 *   handlers = {
 *     "storage" = "Drupal\virtual_entities\Entity\VirtualEntityStorage",
 *     "storage_schema" = "Drupal\virtual_entities\Entity\VirtualEntityStorageSchema",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "access" = "Drupal\virtual_entities\Access\VirtualEntityAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\virtual_entities\VirtualEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "edit" = "Drupal\virtual_entities\VirtualEntityForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\virtual_entities\Entity\VirtualEntityRouteProvider",
 *     },
 *     "list_builder" = "Drupal\virtual_entities\Entity\VirtualEntityListBuilder",
 *   },
 *   translatable = FALSE,
 *   entity_keys = {
 *     "id" = "id",
 *     "bundle" = "type",
 *     "label" = "title",
 *     "uuid" = "uuid"
 *   },
 *   bundle_entity_type = "virtual_entity_type",
 *   field_ui_base_route = "entity.virtual_entity_type.edit_form",
 *   common_reference_target = TRUE,
 *   permission_granularity = "bundle",
 *   links = {
 *     "canonical" = "/virtual-entity/{virtual_entity}",
 *     "delete-form" = "/virtual-entity/{virtual_entity}/delete",
 *     "edit-form" = "/virtual-entity/{virtual_entity}/edit",
 *     "collection" = "/virtual-entity",
 *   }
 * )
 */
class VirtualEntity extends ContentEntityBase implements VirtualEntityInterface {

  /**
   * {@inheritdoc}
   */
  public function virtualId() {
    return parent::id();
  }

  /**
   * {@inheritdoc}
   */
  public function getType() {
    return $this->bundle();
  }

  /**
   * {@inheritdoc}
   */
  public function id() {
    return self::getType() . '-' . self::virtualId();
  }

  /**
   * {@inheritdoc}
   */
  public function preSave(EntityStorageInterface $storage) {
    parent::preSave($storage);

    if (method_exists($storage, 'preSave')) {
      $storage->preSave($this);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function preDelete(EntityStorageInterface $storage, array $entities) {
    parent::preDelete($storage, $entities);

    if (method_exists($storage, 'preDelete')) {
      $storage->preDelete($entities);
    }
  }

  /**
   * {@inheritdoc}
   */
  public static function baseFieldDefinitions(EntityTypeInterface $entity_type) {
    $fields['id'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Virtual Entity ID'))
      ->setDescription(t('The virtual entity ID.'))
      ->setReadOnly(TRUE);

    $fields['uuid'] = BaseFieldDefinition::create('uuid')
      ->setLabel(t('UUID'))
      ->setDescription(t('The virtual entity UUID.'))
      ->setReadOnly(TRUE);

    $fields['type'] = BaseFieldDefinition::create('entity_reference')
      ->setLabel(t('Type'))
      ->setDescription(t('The virtual entity type.'))
      ->setSetting('target_type', 'virtual_entity_type')
      ->setReadOnly(TRUE);

    $fields['title'] = BaseFieldDefinition::create('string')
      ->setLabel(t('Title'))
      ->setRequired(TRUE)
      ->setTranslatable(FALSE)
      ->setRevisionable(FALSE)
      ->setDefaultValue('')
      ->setSetting('max_length', 255)
      ->setDisplayOptions('view', [
        'label' => 'hidden',
        'type' => 'string',
        'weight' => -5,
      ])
      ->setDisplayOptions('form', [
        'type' => 'string_textfield',
        'weight' => -5,
      ])
      ->setDisplayConfigurable('form', TRUE);

    return $fields;
  }

  /**
   * {@inheritdoc}
   */
  public function getMappedObject() {
    $bundle = $this->entityManager()->getStorage('virtual_entity_type')->load($this->bundle());
    $object = new \stdClass();
    foreach ($bundle->getFieldMappings() as $source => $destination) {
      $field_definition = $this->getFieldDefinition($source);
      $settings = $field_definition->getSettings();
      $property = $field_definition->getFieldStorageDefinition()->getMainPropertyName();

      $offset = 0;
      // Special case for references to external entities.
      if (isset($settings['target_type']) && $settings['target_type'] === 'virtual_entity') {
        // Only 1 bundle is allowed.
        $target_bundle = reset($settings['handler_settings']['target_bundles']);
        $offset = strlen($target_bundle) + 1;
      }
      // If the field has many item we process each one.
      if ($this->get($source)->count() > 1) {
        $values = $this->get($source)->getValue();
        $object->{$destination} = [];
        foreach ($values as $value_row) {
          $object->{$destination}[] = substr($value_row[$property], $offset);
        }
      }
      else {
        $object->{$destination} = substr($this->get($source)->{$property}, $offset);
      }
    }
    return $object;
  }

  /**
   * {@inheritdoc}
   */
  public function mapObject(\stdClass $obj) {
    // Don't touch the original object.
    $object = clone $obj;
    $bundle = $this->entityManager()->getStorage('virtual_entity_type')->load($this->bundle());

    foreach ($bundle->getFieldMappings() as $destination => $source) {
      $field_definition = $this->getFieldDefinition($destination);
      // When there is no definition go to the next item.
      if (!$field_definition) {
        continue;
      }
      $settings = $field_definition->getSettings();
      $property = $field_definition->getFieldStorageDefinition()->getMainPropertyName();

      $value_prefix = '';
      // Special case for references to external entities.
      if (isset($settings['target_type']) && $settings['target_type'] === 'virtual_entity') {
        // Only 1 bundle is allowed.
        $target_bundle = reset($settings['handler_settings']['target_bundles']);
        $value_prefix = $target_bundle . '-';
      }
      // Array of value for the entity.
      $destination_value = [];
      // Set at least an empty string for the destination.
      $object->{$source} = isset($object->{$source}) ? $object->{$source} : '';
      // Convert to array.
      if (!is_array($object->{$source})) {
        $object->{$source} = [$object->{$source}];
      }
      foreach ($object->{$source} as $value) {
        // For array cases we assume the property keys arrive from the client
        // correctly.
        if (is_array($value)) {
          $destination_value[] = $value;
        }
        else {
          $destination_value[] = [$property => $value_prefix . $value];
        }
      }
      $this->set($destination, $destination_value);
    }
    return $this;
  }

}
