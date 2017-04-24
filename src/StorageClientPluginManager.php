<?php

namespace Drupal\virtual_entities;

use Drupal\Core\Extension\ModuleHandlerInterface;
use Drupal\Core\Plugin\DefaultPluginManager;
use Drupal\Core\Cache\CacheBackendInterface;

/**
 * Class StorageClientPluginManager.
 *
 * @package Drupal\virtual_entities
 */
class StorageClientPluginManager extends DefaultPluginManager {

  /**
   * The subdirectory within a namespace to look for plugins.
   *
   * @var string|bool
   */
  protected $pluginDir = 'Plugin/VirtualEntityStorageClient';

  /**
   * Plugin interface class.
   *
   * @var string
   */
  protected $pluginInterface = 'Drupal\virtual_entities\StorageClient\StorageClientInterface';

  /**
   * Plugin annotation class.
   *
   * @var string
   */
  protected $pluginDefinitionAnnotationName = '';

  /**
   * Plugin annotation class namespace.
   *
   * @var array
   */
  protected $additionalAnnotationNamespaces = [];

  /**
   * {@inheritdoc}
   */
  public function __construct(\Traversable $namespaces, CacheBackendInterface $cache_backend, ModuleHandlerInterface $module_handler) {
    parent::__construct(
      $this->pluginDir,
      $namespaces,
      $module_handler,
      $this->pluginInterface,
      $this->pluginDefinitionAnnotationName,
      $this->additionalAnnotationNamespaces
    );

    $this->alterInfo('virtual_entity_storage_client_info');
    $this->setCacheBackend($cache_backend, 'virtual_entity_storage_client');
  }

}
