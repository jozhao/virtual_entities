<?php

namespace Drupal\virtual_entities\StorageClient;

use Drupal\Component\Plugin\PluginBase;

/**
 * Class StorageClientAbstract.
 *
 * @package Drupal\virtual_entities\StorageClient
 */
abstract class StorageClientAbstract extends PluginBase implements StorageClientInterface {

  /**
   * The HTTP client to fetch the data with.
   *
   * @var \GuzzleHttp\ClientInterface
   */
  protected $httpClient;

  /**
   * {@inheritdoc}
   */
  public function __construct(array $configuration, $plugin_id, $plugin_definition) {
    parent::__construct($configuration, $plugin_id, $plugin_definition);

    $this->httpClient = $this->configuration['http_client'];
  }

}
