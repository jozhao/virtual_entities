<?php

namespace Drupal\virtual_entities\Storage;

use Drupal\Core\Entity\ContentEntityInterface;
use Drupal\Core\Entity\ContentEntityStorageBase;
use Drupal\Core\Entity\EntityInterface;
use Drupal\Core\Field\FieldDefinitionInterface;

/**
 * Class VirtualEntityStorage.
 *
 * @package Drupal\virtual_entities\Storage
 */
class VirtualEntityStorage extends ContentEntityStorageBase {

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
  protected function doLoadMultiple(array $ids = NULL) {
    // TODO: Implement doLoadMultiple() method.
  }

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