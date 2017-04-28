<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;

/**
 * Defines the Virtual Entity type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "virtual_entity_type",
 *   label = @Translation("Virtual entity type"),
 *   handlers = {
 *     "access" = "Drupal\virtual_entities\Access\VirtualEntityTypeAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\virtual_entities\Form\VirtualEntityTypeForm",
 *       "edit" = "Drupal\virtual_entities\Form\VirtualEntityTypeForm",
 *       "delete" = "Drupal\virtual_entities\Form\VirtualEntityTypeDeleteConfirm"
 *     },
 *     "list_builder" = "Drupal\virtual_entities\Entity\VirtualEntityTypeListBuilder",
 *   },
 *   admin_permission = "administer virtual entity types",
 *   config_prefix = "type",
 *   bundle_of = "virtual_entity",
 *   entity_keys = {
 *     "id" = "type",
 *     "label" = "label"
 *   },
 *   links = {
 *     "edit-form" = "/admin/structure/virtual-entity-types/manage/{virtual_entity_type}",
 *     "delete-form" = "/admin/structure/virtual-entity-types/manage/{virtual_entity_type}/delete",
 *     "collection" = "/admin/structure/virtual-entity-types",
 *   },
 *   config_export = {
 *     "label",
 *     "type",
 *     "description",
 *     "help",
 *     "endpoint",
 *     "format",
 *     "field_mappings",
 *   }
 * )
 */
class VirtualEntityType extends ConfigEntityBundleBase implements VirtualEntityTypeInterface {

  /**
   * The human-readable name of the entity type.
   *
   * @var string
   */
  protected $label;

  /**
   * The machine name of this entity type.
   *
   * @var string
   */
  protected $type;

  /**
   * A brief description of this entity type.
   *
   * @var string
   */
  protected $description;

  /**
   * Help information shown to the user when creating a entity of this type.
   *
   * @var string
   */
  protected $help;

  /**
   * The endpoint of this entity type.
   *
   * @var string
   */
  protected $endpoint;

  /**
   * The format in which to make the requests for this entity type.
   *
   * For example: 'json'.
   *
   * @var string
   */
  protected $format = 'json';

  /**
   * The field mappings for this virtual entity type.
   *
   * @var array
   */
  protected $field_mappings = [];

  /**
   * {@inheritdoc}
   */
  public function id() {
    return $this->type;
  }

  /**
   * {@inheritdoc}
   */
  public function isLocked() {
    $locked = \Drupal::state()->get('virtual_entity.type.locked');
    return isset($locked[$this->id()]) ? $locked[$this->id()] : FALSE;
  }

  /**
   * {@inheritdoc}
   */
  public function getDescription() {
    return $this->description;
  }

  /**
   * {@inheritdoc}
   */
  public function getHelp() {
    return $this->help;
  }

  /**
   * {@inheritdoc}
   */
  public function getEndPoint() {
    return $this->endpoint;
  }

  /**
   * {@inheritdoc}
   */
  public function getFormat() {
    return $this->format;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldMappings() {
    return $this->field_mappings;
  }

  /**
   * {@inheritdoc}
   */
  public function getFieldMapping($field_name) {
    return isset($this->field_mappings[$field_name]) ? $this->field_mappings[$field_name] : FALSE;
  }

}
