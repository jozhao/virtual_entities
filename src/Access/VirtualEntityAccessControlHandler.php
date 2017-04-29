<?php

namespace Drupal\virtual_entities\Access;

use Drupal\Core\Entity\EntityAccessControlHandler;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Session\AccountInterface;
use Drupal\Core\Access\AccessResult;

/**
 * Class VirtualEntityAccessControlHandler.
 *
 * @package Drupal\virtual_entities\Access
 */
class VirtualEntityAccessControlHandler extends EntityAccessControlHandler {

  /**
   * {@inheritdoc}
   */
  public function access(EntityInterface $entity, $operation, AccountInterface $account = NULL, $return_as_object = FALSE) {
    $account = $this->prepareUser($account);
    $result = parent::access($entity, $operation, $account, TRUE);

    if ($result->isForbidden()) {
      return $return_as_object ? $result : $result->isAllowed();
    }
    $permission = $operation === 'update' ? "edit {$entity->bundle()} virtual entity" : "{$operation} {$entity->bundle()} virtual entity";
    $result = AccessResult::allowedIfHasPermission($account, $permission);

    return $return_as_object ? $result : $result->isAllowed();
  }

  /**
   * {@inheritdoc}
   */
  public function checkAccess(EntityInterface $entity, $operation, AccountInterface $account) {
    $result = parent::checkAccess($entity, $operation, $account);
    if ($result->isForbidden()) {
      return $result;
    }

    // No opinion.
    return AccessResult::neutral();
  }

  /**
   * {@inheritdoc}
   */
  protected function checkCreateAccess(AccountInterface $account, array $context, $entity_bundle = NULL) {
    return AccessResult::allowedIfHasPermission($account, 'add contact entity');
  }

}
