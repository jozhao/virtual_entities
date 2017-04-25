<?php

namespace Drupal\virtual_entities\Plugin\VirtualEntity;

use Drupal\Component\Plugin\PluginManagerInterface;

/**
 * Class StorageClientLoader.
 *
 * @package Drupal\virtual_entities\Plugin\VirtualEntity
 */
class StorageClientLoader {

  /**
   * The storage client manager.
   *
   * @var \Drupal\Component\Plugin\PluginManagerInterface
   */
  protected $storageClientManager;

  protected $storageClients = [];

  public function __construct(PluginManagerInterface $storage_client_manager, $bundle = '') {
    $this->storageClientManager = $storage_client_manager;
  }

  public function addStorageClient($bundle_id) {
    // Get bundle settings.
    $bundle = \Drupal::entityTypeManager()->getStorage('virtual_entity_type')->load($bundle_id);
    // Set storage client plugin configuration.
    $plugin_id = 'virtual_entity_client_restful';
    $plugin_configuration = [
      'endpoint' => $bundle->getEndPoint(),
      'format' => $bundle->getFormat(),
    ];

    // Save bundle storage client class.
    $this->storageClients[$bundle_id] = $this->storageClientManager->createInstance(
      $plugin_id,
      $plugin_configuration
    );
  }

}
