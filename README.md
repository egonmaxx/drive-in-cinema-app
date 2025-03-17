#Create a docker image and a container

docker-compose up -d

#Install the application

docker exec -ti driveincinema_backend_web bash

sh shartup.sh

#Try the applicaton

Type http://localhost:22080/api/documentation into you browser seach field
