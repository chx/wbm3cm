<?php

namespace Drupal\wbm3cm\Deriver;

use Drupal\Component\Plugin\Derivative\DeriverBase;

class Step1 extends DeriverBase {

  /**
   * {@inheritdoc}
   */
  public function getDerivativeDefinitions($base_plugin_definition) {
    foreach (\Drupal::state()->get('wbm3cm') as $entity_type_id => $bundles) {
      /** @var \Drupal\Core\Entity\ContentEntityTypeInterface $entity_type */
      $entity_type = \Drupal::entityTypeManager()->getDefinition($entity_type_id);
      $definition = $base_plugin_definition;
      $definition['source'] += [
        'base_table' => $entity_type->getBaseTable(),
        'revision_data_table' => $entity_type->getRevisionDataTable(),
        'id_field' => $entity_type->getKey('id'),
        'revision_id_field' => $entity_type->getKey('revision'),
        'langcode_field' => $entity_type->getKey('langcode'),
        'bundle_field' => $entity_type->getKey('bundle'),
        'bundles' => $bundles,
      ];
      $this->derivatives[$entity_type_id] = $this->addMore($definition, $entity_type_id);
    }
    return parent::getDerivativeDefinitions($base_plugin_definition);
  }

  protected function addMore(array $definition, $entity_type_id) {
    return $definition;
  }
}
