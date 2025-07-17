FROM ubuntu:latest
RUN apt-get update
RUN apt-get install -y nginx
WORKDIR /data
EXPOSE 80
EXPOSE 443
CMD ["nginx", "-g", "daemon off;"]
