wbm2cm exists and some of the ideas I borrowed from there but this module takes
such a different approach to the relevant changes to the entities that I
decided to name it wbm3cm.

We use the migrate API to

1. Save the moderation state into a map. The migration ID map, that is.

2. Change the moderation_state to NULL now that we saved them.

3. Restore from 1.

We also need to

2.a. Rename the workbench moderation configuration entities and remove their dependency on workbench_moderation (todo)
2.b. Uninstall workbench moderation
2.c. Install content moderation
2.d. Recreate all the configuration (todo, steal from wbm2cm)


