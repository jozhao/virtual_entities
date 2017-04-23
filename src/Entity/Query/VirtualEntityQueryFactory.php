<?php

namespace Drupal\virtual_entities\Entity\Query;

use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\Query\QueryFactoryInterface;

/**
 * Class VirtualEntityQueryFactory.
 *
 * @package Drupal\virtual_entities\Entity\Query
 */
class VirtualEntityQueryFactory implements QueryFactoryInterface {

  /**
   * {@inheritdoc}
   */
  public function get(EntityTypeInterface $entity_type, $conjunction) {
    // TODO: Implement get() method.
  }

  /**
   * {@inheritdoc}
   */
  public function getAggregate(EntityTypeInterface $entity_type, $conjunction) {
    // TODO: Implement getAggregate() method.
  }

}
