<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Entity\ContentEntityBase;
use Drupal\Core\Entity\EntityChangedTrait;
use Drupal\Core\Entity\EntityPublishedTrait;
use Drupal\Core\Entity\EntityStorageInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Field\BaseFieldDefinition;
use Drupal\Core\Session\AccountInterface;
use Drupal\virtual_entities\VirtualEntityInterface;

/**
 * Defines the virtual entity class.
 * @ContentEntityType(
 *   id = "virtual_entity",
 *   label = @Translation("Virtual entity"),
 *   bundle_label = @Translation("Virtual entity type"),
 *   handlers = {
 *     "storage" = "Drupal\virtual_entities\VirtualEntityStorage",
 *     "storage_schema" = "Drupal\virtual_entities\VirtualEntityStorageSchema",
 *     "view_builder" = "Drupal\Core\Entity\EntityViewBuilder",
 *     "access" = "Drupal\virtual_entities\VirtualEntityAccessControlHandler",
 *     "form" = {
 *       "default" = "Drupal\virtual_entities\VirtualEntityForm",
 *       "delete" = "Drupal\Core\Entity\ContentEntityDeleteForm",
 *       "edit" = "Drupal\virtual_entities\VirtualEntityForm"
 *     },
 *     "route_provider" = {
 *       "html" = "Drupal\virtual_entities\Entity\VirtualEntityRouteProvider",
 *     },
 *     "list_builder" = "Drupal\virtual_entities\VirtualEntityListBuilder",
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
  public function getType() {
    return $this->bundle();
  }

}
