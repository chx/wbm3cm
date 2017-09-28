<?php

namespace Drupal\wbm3cm\Plugin\migrate\source;

use Drupal\Core\State\StateInterface;
use Drupal\migrate\Plugin\migrate\source\SqlBase;
use Drupal\migrate\Plugin\MigrationInterface;

/**
 *
 * @MigrateSource(
 *   id = "wbm3cm",
 *   source_module = "wbm3cm"
 * )
 */
class Wbm3Cm extends SqlBase {

  public function __construct(array $configuration, $plugin_id, $plugin_definition, MigrationInterface $migration, StateInterface $state) {
    $configuration['key'] = 'default';
    parent::__construct($configuration, $plugin_id, $plugin_definition, $migration, $state);
  }


  /**
   * @return \Drupal\Core\Database\Query\SelectInterface
   */
  public function query() {
    $query = $this->select($this->configuration['revision_data_table'], 'r');
    $id_field = $this->configuration['id_field'];
    $query->addField('r', $this->configuration['revision_id_field']);
    $query->addField('r', $this->configuration['langcode_field']);
    if (!empty($this->configuration['moderation_state'])) {
      $query->addField('r', 'moderation_state');
    }
    $query->innerJoin($this->configuration['base_table'], 'b', "r.$id_field = b.$id_field");
    $query->condition($this->configuration['bundle_field'], $this->configuration['bundles'], 'IN');
    return $query;
  }

  /**
   * {@inheritdoc}
   */
  public function getIds() {
    $ids[$this->configuration['revision_id_field']] = [
      'type' => 'integer',
      'alias' => 'r',
    ];
    $ids[$this->configuration['langcode_field']] = [
      'type' => 'string',
      'alias' => 'r',
    ];
    return $ids;
  }

  /**
   * {@inheritdoc}
   */
  public function fields() {
    $fields[$this->configuration['revision_id_field']]['type'] = 'integer';
    $fields[$this->configuration['langcode_field']]['type'] = 'string';
    if (!empty($this->configuration['moderation_state'])) {
      $fields['moderation_state']['type'] = 'integer';
    }
    return $fields;
  }

}
