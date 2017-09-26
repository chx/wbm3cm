<?php

namespace Drupal\wbm3cm\Plugin\migrate\source;

use Drupal\migrate\Plugin\migrate\source\SqlBase;

class Wbm3Cm extends SqlBase {

  /**
   * @return \Drupal\Core\Database\Query\SelectInterface
   */
  public function query() {
    $query = $this->select($this->configuration['revision_data_table'], 'r');
    $revision_id_field = $this->configuration['revision_id_field'];
    $query->addField('r', $revision_id_field, $revision_id_field);
    if (!empty($this->configuration['moderation_state'])) {
      $query->addField('r', 'moderation_state',  'moderation_state');
    }
    $query->condition($this->configuration['bundle_field'], $this->configuration['bundles'], 'IN');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids[$this->configuration['revision_id_field']]['type'] = 'integer';
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields[$this->configuration['revision_id_field']]['type'] = 'integer';
    if (!empty($this->configuration['moderation_state'])) {
      $fields['moderation_state']['type'] = 'integer';
    }
    return $fields;
  }

}
