# Set the base image for subsequent instructions
FROM webdevops/php-nginx:8.3-alpine

# Installation dans votre Image du minimum pour que Docker fonctionne
RUN apk add oniguruma-dev libxml2-dev
RUN docker-php-ext-install \
        bcmath \
        ctype \
        fileinfo \
        mbstring \
        pdo_mysql \
        xml

# Installation dans votre image de Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer


# Installation dans votre image de NodeJS
RUN apk add nodejs npm
#
ENV WEB_DOCUMENT_ROOT /app/public
ENV APP_ENV production

# Set working directory
WORKDIR /app

# Copy the rest of the application
COPY . .

# RUN rm -rf ./storage

# On copie le fichier .env.example pour le renommer en .env
# Vous pouvez modifier le .env.example pour indiquer la configuration de votre site pour la production
RUN cp -n .env.example .env

# Exposer le port 80 pour accéder à l'application via HTTP
EXPOSE 80

# Copy existing application directory permissions
RUN chown -R application:application .
