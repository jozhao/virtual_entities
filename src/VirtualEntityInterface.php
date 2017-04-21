<?php

namespace Drupal\virtual_entities;

use Drupal\Core\Entity\EntityPublishedInterface;
use Drupal\Core\Entity\RevisionLogInterface;
use Drupal\user\EntityOwnerInterface;
use Drupal\Core\Entity\EntityChangedInterface;
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

}
