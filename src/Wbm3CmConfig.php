<?php

namespace Drupal\wbm3cm;

use Drupal\workflows\Entity\Workflow;

class Wbm3CmConfig {

  const KEY = 'wbm3cm_saved_config';

  public static function save() {
    \Drupal::state()->set(static::KEY, [
      static::getAll('workbench_moderation.moderation_state.'),
      static::getAll('workbench_moderation.moderation_state_transition.'),
    ]);
  }

  public static function restore() {
    list($states, $transitions) = \Drupal::state()->get(static::KEY);
    // Create and save a workflow entity with the information gathered.
    // Note: this implies all entities will be squished into a single workflow.
    $workflow_config = [
      'id' => 'content_moderation_workflow',
      'label' => 'Content Moderation Workflow',
      'type' => 'content_moderation',
      'type_settings' => [
        'states' => [],
        'transitions' => [],
      ],
    ];
    foreach ($states as $state) {
      $workflow_config['type_settings']['states'][$state['id']] = [
        'label' => $state['label'],
        'published' => $state['published'],
        'default_revision' => $state['default_revision'],
      ];
    }
    foreach ($transitions as $transition) {
      $workflow_config['type_settings']['transitions'][$transition['id']] = [
        'label' => $transition['label'],
        'to' => $transition['stateTo'],
        'from' => explode(',', $transition['stateFrom']),
      ];
    }
    $workflow = new Workflow($workflow_config, 'workflow');
    $workflow_type_plugin = $workflow->getTypePlugin();
    foreach (\Drupal::state()->get('wbm3cm') as $entity_type_id => $bundles) {
      foreach ($bundles as $bundle_id) {
        $workflow_type_plugin->addEntityTypeAndBundle($entity_type_id, $bundle_id);
      }
    }
    $workflow->save();
  }

  public static function getAll($prefix) {
    $cf = \Drupal::configFactory();
    $return = [];
    foreach ($cf->listAll($prefix) as $id) {
      $return[] = $cf->getEditable($id)->get();
    }
    return $return;
  }

}
