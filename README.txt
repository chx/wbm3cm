wbm2cm exists and I took the config rebuild and the overall steps necessary
from there. But the implementation of how entities are handled are
completely different and so I decided to make this a separate module.

We use the migrate API to

1. Save the moderation state into a map. The migration ID map, that is.

2. Change the moderation_state to NULL now that we saved them.

3. Restore from 1.

We also need to

2.a. Save the workbench moderation configuration
2.b. Uninstall workbench moderation
2.c. Install content moderation
2.d. Recreate all the configuration

wbm3cm.sh does all these steps for nodes. Writing a better runner and a GUI is
left as an exercise to the reader.
