<?php

namespace Drupal\virtual_entities\StorageClient;

use Drupal\Component\Plugin\PluginInspectionInterface;
use Drupal\virtual_entities\VirtualEntityInterface;

/**
 * Interface StorageClientInterface.
 *
 * @package Drupal\virtual_entities\StorageClient
 */
interface StorageClientInterface extends PluginInspectionInterface {

  /**
   * Get the client plugin name.
   *
   * @return string
   *   The client plugin name.
   */
  public function getPluginName();

  /**
   * Load the entity.
   *
   * @param mixed $id
   *   The entity ID.
   *
   * @return mixed
   *   The entity null if nothing is found.
   */
  public function load($id);

  /**
   * Save entity.
   *
   * @param \Drupal\virtual_entities\VirtualEntityInterface $entity
   *   The entity object.
   *
   * @return int
   *   SAVED_NEW or SAVED_UPDATED is returned.
   */
  public function save(VirtualEntityInterface $entity);

  /**
   * Query entity.
   *
   * @param array $parameters
   *   Key-value pairs to query.
   *
   * @return mixed
   *   The virtual entities.
   */
  public function query(array $parameters);

}
