FROM node:11-alpine

RUN mkdir -p /app
WORKDIR /app

RUN apk --no-cache update && \
    apk --no-cache add make bash g++ zlib-dev libpng-dev && \
    rm -fr /var/cache/apk/*

RUN npm install -g npm

ENTRYPOINT ["yarn"]
