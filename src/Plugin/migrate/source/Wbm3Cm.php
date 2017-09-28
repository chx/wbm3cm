<?php

namespace Drupal\wbm3cm\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

/**
 *
 * @MigrateSource(
 *   id = "wbm3cm",
 *   source_module = "wbm3cm"
 * )
 */
class Wbm3Cm extends SqlBase {

  /**
   * @return \Drupal\Core\Database\Query\SelectInterface
   */
  public function query() {
    $query = $this->select($this->configuration['revision_data_table'], 'r');
    $query->addField('r', $this->configuration['revision_id_field'], 'revision_id');
    $query->addField('r', 'langcode');
    if (!empty($this->configuration['moderation_state'])) {
      $query->addField('r', 'moderation_state');
    }
    $query->condition($this->configuration['bundle_field'], $this->configuration['bundles'], 'IN');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids['revision_id']['type'] = 'integer';
    $fields['langcode']['type'] = 'string';
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields['revision_id']['type'] = 'integer';
    $fields['langcode']['type'] = 'string';
    if (!empty($this->configuration['moderation_state'])) {
      $fields['moderation_state']['type'] = 'integer';
    }
    return $fields;
  }

}
