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

  /**
   * The storage clients array.
   *
   * @var array
   */
  private static $storageClients = [];

  /**
   * StorageClientLoader constructor.
   *
   * @param \Drupal\Component\Plugin\PluginManagerInterface $storage_client_manager
   *   Client manager class.
   * @param string $bundle_id
   *   Bundle id.
   */
  public function __construct(PluginManagerInterface $storage_client_manager, $bundle_id = '') {
    $this->storageClientManager = $storage_client_manager;
  }

  /**
   * Add Storage client.
   *
   * @param string $bundle_id
   *   Bundle id.
   */
  public function addStorageClient($bundle_id) {
    // Get bundle settings.
    $bundle = \Drupal::entityTypeManager()
      ->getStorage('virtual_entity_type')
      ->load($bundle_id);
    // Set storage client plugin configuration.
    $plugin_id = 'virtual_entity_client_restful';
    $plugin_configuration = [
      'endpoint' => $bundle->getEndPoint(),
      'format' => $bundle->getFormat(),
    ];

    // Save bundle storage client class.
    self::$storageClients[$bundle_id] = $this->storageClientManager->createInstance(
      $plugin_id,
      $plugin_configuration
    );
  }

  /**
   * Get Storage client.
   *
   * @param string $build_id
   *   Bundle id.
   *
   * @return mixed
   *   Storage client instance.
   */
  public function getStorageClient($build_id) {
    if (!isset(self::$storageClients[$build_id])) {
      $this->addStorageClient($build_id);
    }

    return self::$storageClients[$build_id];
  }

}
