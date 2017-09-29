drush en -y migrate_run,wbm3cm
drush mi wbm3cm_step1:node
drush mi wbm3cm_step2:node
drush ev 'Drupal\wbm3cm\Wbm3CmConfig::save()'
drush pmu -y workbench_moderation
drush en -y content_moderation
drush ev 'Drupal\wbm3cm\Wbm3CmConfig::restore()'
drush mi wbm3cm_step3:node
