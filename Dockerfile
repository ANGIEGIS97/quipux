FROM wordpress:latest

# Install required packages
RUN apt-get update && apt-get install -y \
    unzip \
    && rm -rf /var/lib/apt/lists/*

# Install WP-CLI
RUN curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar && \
    chmod +x wp-cli.phar && \
    mv wp-cli.phar /usr/local/bin/wp

# Download and install wp-bootstrap-starter theme
RUN curl -o /tmp/wp-bootstrap-starter.zip https://downloads.wordpress.org/theme/wp-bootstrap-starter.3.3.6.zip && \
    unzip /tmp/wp-bootstrap-starter.zip -d /var/www/html/wp-content/themes/ && \
    rm /tmp/wp-bootstrap-starter.zip

# Create and configure child theme directory
COPY ./wp-content/themes/base-quipux /var/www/html/wp-content/themes/base-quipux

# Copy custom plugin
COPY ./wp-content/plugins/quipux-api /var/www/html/wp-content/plugins/quipux-api

# Set permissions
RUN chown -R www-data:www-data /var/www/html/wp-content
