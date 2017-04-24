<?php

namespace Drupal\virtual_entities\Plugin\VirtualEntity;

/**
 * Class StorageClientBase.
 *
 * @package Drupal\virtual_entities\StorageClient
 */
abstract class StorageClientBase extends StorageClientAbstract {

  /**
   * {@inheritdoc}
   */
  public function getPluginName() {
    if (isset($this->pluginDefinition['name'])) {
      return $this->pluginDefinition['name'];
    }
    else {
      return NULL;
    }
  }

}
