<?php

/**
 * @file
 * Contains Drupal\virtual_entities\VirtualEntityTypeInterface.
 */

namespace Drupal\virtual_entities;

use Drupal\Core\Config\Entity\ConfigEntityInterface;

/**
 * Interface VirtualEntityTypeInterface
 *
 * @package Drupal\virtual_entities
 */
interface VirtualEntityTypeInterface extends ConfigEntityInterface {

  /**
   * Gets the description.
   *
   * @return string
   */
  public function getDescription();

  /**
   * Gets the help information.
   *
   * @return string
   */
  public function getHelp();

  /**
   * Gets the client endpoint.
   *
   * @return string
   */
  public function getEndpoint();

}
