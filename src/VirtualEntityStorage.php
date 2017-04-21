<?php

namespace Drupal\virtual_entities;

use Drupal\Core\Entity\EntityInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Drupal\Core\Entity\EntityTypeInterface;
use Drupal\Core\Entity\ContentEntityStorageBase;
use Drupal\Core\Field\FieldDefinitionInterface;
use Drupal\Core\Entity\ContentEntityInterface;

/**
 * Defines the storage handler class.
 *
 * This extends the base storage class, adding required special handling for
 * virtual entities.
 */
class VirtualEntityStorage extends ContentEntityStorageBase {

  /**
   * {@inheritdoc}
   */
  public static function createInstance(ContainerInterface $container, EntityTypeInterface $entity_type) {
    return new static(
      $entity_type,
      $container->get('entity.manager'),
      $container->get('cache.entity')
    );
  }

  /**
   * {@inheritdoc}
   */
  public function doLoadMultiple(array $ids = NULL) {
    // TODO: Implement doLoadMultiple() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function readFieldItemsToPurge(FieldDefinitionInterface $field_definition, $batch_size) {
    // TODO: Implement readFieldItemsToPurge() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function purgeFieldItems(ContentEntityInterface $entity, FieldDefinitionInterface $field_definition) {
    // TODO: Implement purgeFieldItems() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function doLoadRevisionFieldItems($revision_id) {
    // TODO: Implement doLoadRevisionFieldItems() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function doSaveFieldItems(ContentEntityInterface $entity, array $names = []) {
    // TODO: Implement doSaveFieldItems() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function doDeleteFieldItems($entities) {
    // TODO: Implement doDeleteFieldItems() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function doDeleteRevisionFieldItems(ContentEntityInterface $revision) {
    // TODO: Implement doDeleteRevisionFieldItems() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function has($id, EntityInterface $entity) {
    // TODO: Implement has() method.
  }

  /**
   * {@inheritdoc}
   */
  protected function getQueryServiceName() {
    // TODO: Implement getQueryServiceName() method.
  }

  /**
   * {@inheritdoc}
   */
  public function countFieldData($storage_definition, $as_bool = FALSE) {
    // TODO: Implement countFieldData() method.
  }

}
