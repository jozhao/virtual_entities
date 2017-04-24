<?php

namespace Drupal\virtual_entities\Annotation;

use Drupal\Component\Annotation\Plugin;

/**
 * Class StorageClient.
 *
 * @package Drupal\virtual_entities\Annotation
 *
 * @Annotation
 */
class StorageClient extends Plugin {

  /**
   * The plugin ID.
   *
   * @var string
   */
  public $id;

  /**
   * The name of the storage client.
   *
   * @var \Drupal\Core\Annotation\Translation
   *
   * @ingroup plugin_translatable
   */
  public $name;

}
