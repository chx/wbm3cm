wbm2cm exists and some of the ideas I borrowed from there but this module takes
such a different approach to the relevant changes to the entities that I
decided to name it wbm3cm.

We use the migrate API to

1. Save the moderation state into a map. The migration ID map, that is.

2. Change the moderation_state to NULL now that we saved them.

3. Rename the workflow configuration entities and remove their dependency on workbench_moderation (todo)

4. Create the map from wbm states to cm states

5. Apply those to the entities -- the old state can be found via migration_lookup

