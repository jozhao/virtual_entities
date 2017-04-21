<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Config\Entity\ConfigEntityBundleBase;
use Drupal\virtual_entities\VirtualEntityTypeInterface;

/**
 * Defines the Virtual Entity type configuration entity.
 *
 * @ConfigEntityType(
 *   id = "virtual_entity_type",
 *   label = @Translation("Virtual Entity type"),
 *   handlers = {
 *     "access" = "Drupal\virtual_entities\VirtualEntityTypeAccessControlHandler",
 *     "form" = {
 *       "add" = "Drupal\virtual_entities\VirtualEntityTypeForm",
 *       "edit" = "Drupal\virtual_entities\VirtualEntityTypeForm",
 *       "delete" = "Drupal\virtual_entities\Form\VirtualEntityTypeDeleteConfirm"
 *     },
 *     "list_builder" = "Drupal\virtual_entities\VirtualEntityTypeListBuilder",
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
   * {@inheritdoc}
   */
  public function id() {
    return $this->type;
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
  public function getEndpoint() {
    return $this->endpoint;
  }

}
