<?php

namespace Drupal\virtual_entities\Entity;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Interface VirtualEntityTypeInterface.
 *
 * @package Drupal\virtual_entities
 */
interface VirtualEntityTypeInterface extends ConfigEntityInterface {

  /**
   * Gets the description.
   *
   * @return string
   *   The description of this entity type.
   */
  public function getDescription();

  /**
   * Gets the help information.
   *
   * @return string
   *   The help information of this entity type.
   */
  public function getHelp();

  /**
   * Gets the client endpoint.
   *
   * @return string
   *   The client endpoint of this entity type.
   */
  public function getEndpoint();

  /**
   * Gets the client endpoint parse format.
   *
   * @return string
   *   The client endpoint format of this entity type.
   */
  public function getFormat();

  /**
   * Returns the field mappings of virtual entity type.
   *
   * @return array
   *   An array associative array:
   *     - key: The source property.
   *     - value: The destination field.
   */
  public function getFieldMappings();

  /**
   * Returns the field mapping for the given field of this entity type.
   *
   * @return string|bool
   *   The name of the property this field is mapped to. FALSE if the mapping
   *   doesn't exist.
   */
  public function getFieldMapping($field_name);

}
