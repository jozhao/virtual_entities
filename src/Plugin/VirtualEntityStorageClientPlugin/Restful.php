<?php

namespace Drupal\virtual_entities\Plugin\VirtualEntityStorageClientPlugin;

use Drupal\virtual_entities\Plugin\VirtualEntityStorageClientPluginBase;
use GuzzleHttp\Exception\RequestException;

/**
 * Restful client.
 *
 * @VirtualEntityStorageClientPlugin(
 *   id = "virtual_entity_storage_client_plugin_restful",
 *   label = "RESTful"
 * )
 */
class Restful extends VirtualEntityStorageClientPluginBase {

  /**
   * Results.
   *
   * @var mixed
   */
  private static $results;

  /**
   * {@inheritdoc}
   */
  public function query(array $parameters = []) {
    $parameters = [
      'apiKey' => 'd73db1da583c4270b749e094c0d5cd2a',
      'source' => 'abc-news-au',
      'sortBy' => 'top',
    ];

    try {
      $response = $this->httpClient->get(
        $this->configuration['endpoint'],
        [
          'query' => $parameters,
          'headers' => [],
        ]
      );

      // Fetch data contents from remote.
      $data = $response->getBody()->getContents();
      // Use decoder to parse the data.
      $results = (object) $this->decoder->getDecoder($this->configuration['format'])->decode($data);

      return $results->articles;
    }
    catch (RequestException $e) {
      watchdog_exception('virtual_entities', $e);
    }
  }

  /**
   * {@inheritdoc}
   */
  public function load($id) {
    if (NULL == self::$results) {
      self::$results = $this->query();
    }

    $items = self::$results;

    foreach ($items as $item) {
      $item = (object) $item;
      if (md5($item->url) == $id) {
        return (object) $item;
      }
    }
  }

}
