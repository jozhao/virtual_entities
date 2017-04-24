<?php

namespace Drupal\virtual_entities\Entity;

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
    $entities = array();

    foreach ($ids as $id) {
      if (strpos($id, '-')) {
        list($bundle, $virtualId) = explode('-', $id);
        if ($virtualId) {
          $entities[$id] = $this->create([$this->entityType->getKey('bundle') => $bundle])->mapObject($this->getStorageClient($bundle)->load($virtualId))->enforceIsNew(FALSE);
        }
      }
    }

    return $entities;
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
    return 'entity.query.virtual';
  }

  /**
   * {@inheritdoc}
   */
  public function countFieldData($storage_definition, $as_bool = FALSE) {
    // TODO: Implement countFieldData() method.
  }

}
