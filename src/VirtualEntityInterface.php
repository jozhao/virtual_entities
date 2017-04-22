<?php

namespace Drupal\virtual_entities;

use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Provides an interface defining a virtual entity.
 */
interface VirtualEntityInterface extends ContentEntityInterface {

  /**
   * Gets the virtual entity type.
   *
   * @return string
   *   The virtual entity type.
   */
  public function getType();

  /**
   * Gets the virtual entity identifier.
   *
   * @return string|int|null
   *   The external entity identifier, or NULL if the object does not yet have
   *   an external identifier.
   */
  public function virtualId();

}
