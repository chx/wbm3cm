<?php

namespace Drupal\wbm3cm;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class Wbm3CmDeriver extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    foreach (\Drupal::state()->get('wbm3cm') as $entity_type_id => $bundles) {
      /** @var \Drupal\Core\Entity\ContentEntityTypeInterface $entity_type */
      $entity_type = \Drupal::entityTypeManager()->getDefinition($entity_type_id);
      $definition = $base_plugin_definition;
      $definition['source']['revision_data_table'] = $entity_type->getRevisionDataTable();
      $revision_id_field = $entity_type->getKey('revision_id');
      $definition['source']['revision_id_field'] = $revision_id_field;
      $definition['source']['bundle_field'] = $entity_type->getKey('bundle');
      $definition['source']['bundles'] = $bundles;
      $definition['process'][$revision_id_field] = 'revision_id';
      if (!isset($definition['destination']['plugin'])) {
        $definition['destination']['plugin'] = "nentity_revision:$entity_type_id";
      }
      $this->derivatives[$entity_type_id] = $definition;
    }
    return parent::getDerivativeDefinitions($base_plugin_definition);
  }
}
