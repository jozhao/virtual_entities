<?php

namespace Drupal\virtual_entities;

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

}
