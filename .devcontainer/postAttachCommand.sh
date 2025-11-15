#!/bin/bash

##### postAttachCommand.sh
#
# Do you need to do something each time a user attaches to the container?
#
# set -eux
# export postAttachCommand=true

##### Set Helpful Environment Variables

cp -f ${DEVLITE_CONTAINER_DEVCONTAINER_FOLDER}/.bash_aliases ~/.bash_aliases

##### Run the hello_devlite file.

if [ -x .devcontainer/hello_devlite.sh ]; then
    .devcontainer/hello_devlite.sh
    exit 0
fi

exit 0

##### Add your changes below here.