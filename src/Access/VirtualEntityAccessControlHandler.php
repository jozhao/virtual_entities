<?php

namespace Drupal\virtual_entities\Access;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;

/**
 * Class VirtualEntityAccessControlHandler.
 *
 * @package Drupal\virtual_entities\Access
 */
class VirtualEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $result = parent::checkAccess($entity, $operation, $account);
    if ($result->isForbidden()) {
      return $result;
    }

    return $result;
  }

}
