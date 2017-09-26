<?php

namespace Drupal\wbm3cm\Plugin\migrate\destination;

use Drupal\migrate\Plugin\migrate\destination\DestinationBase;
use Drupal\migrate\Plugin\MigrationInterface;
use Drupal\migrate\Row;


/**
 * @MigrateDestination(
 *   id = "wbm3cm_nothing"
 * )
 */
class Nothing extends DestinationBase {

  /**
   * {@inheritdoc}
   */
  public function import(Row $row, array $old_destination_id_values = []) {
    return $row->getDestinationProperty('to_save');
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['to_save']['type'] = 'string';
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function fields(MigrationInterface $migration = NULL) {
    return [];
  }
}
