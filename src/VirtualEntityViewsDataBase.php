<?php

namespace Drupal\virtual_entities;

use Drupal\views\EntityViewsDataInterface;
use Drupal\Core\Entity\EntityHandlerInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Provides generic views integration for entities.
 */
class VirtualEntityViewsDataBase implements EntityHandlerInterface, EntityViewsDataInterface {

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    // TODO: Implement createInstance() method.
  }

  /**
   * {@inheritdoc}
   */
  public function getViewsData() {
    // TODO: Implement getViewsData() method.
  }

  /**
   * {@inheritdoc}
   */
  public function getViewsTableForEntityType(EntityTypeInterface $entity_type) {
    // TODO: Implement getViewsTableForEntityType() method.
  }

}
