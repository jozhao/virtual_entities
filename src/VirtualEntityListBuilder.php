<?php

namespace Drupal\virtual_entities;

use Drupal\Core\Entity\EntityListBuilder;
use Drupal\Core\StringTranslation\StringTranslationTrait;
use Drupal\Core\Url;

/**
 * Class VirtualEntityListBuilder.
 *
 * @package Drupal\virtual_entities
 */
class VirtualEntityListBuilder {

  use StringTranslationTrait;

  /**
   * {@inheritdoc}
   */
  public function buildHeader() {
    $header['title'] = t('Name');
    $header['endpoint'] = t('Endpoint');
    $header['description'] = [
      'data' => t('Description'),
      'class' => [RESPONSIVE_PRIORITY_MEDIUM],
    ];

    return $header;
  }

  /**
   * {@inheritdoc}
   */
  public function render() {
    // Display empty information.
    $build['table']['#empty'] = $this->t('No virtual entity types available. <a href=":link">Add virtual entity type</a>.', [
      ':link' => Url::fromRoute('virtual_entity.type_add')->toString(),
    ]);

    return $build;
  }

}
