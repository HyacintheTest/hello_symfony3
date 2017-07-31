#Image of the php-apache container that will hold the symfony application
FROM ubuntu:16.04

# Set environment variables.
ENV HOME /root

# disable interactive functions
ENV DEBIAN_FRONTEND noninteractive

#Installation of apache
RUN apt-get update && \
	apt-get install -y apache2  && \
	rm -rf /var/lib/apt/lists/*

#Installation of php
RUN apt-get update && \
	apt-get install -y php libapache2-mod-php  \
	php-cli php-mysqlnd php-xml && \
	rm -rf /var/lib/apt/lists/*

#Adding the application code
#ADD ctest_apps /app


# Define working directory.
WORKDIR /app

EXPOSE 80