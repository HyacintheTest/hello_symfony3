docker-compose down
docker-compose rm -f -v
docker stop $(docker ps -a -q)
docker rm $(docker ps -a -q)
docker rmi $(docker images -a -q) -f
docker-compose build
docker-compose up -d
docker ps
