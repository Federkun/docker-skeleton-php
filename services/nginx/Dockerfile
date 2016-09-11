FROM nginx

# Remove default nginx configs
RUN rm -f /etc/nginx/conf.d/*

# Add nginx config
COPY config/nginx.conf /etc/nginx/nginx.conf

VOLUME ["/var/www", "/etc/nginx/conf.d"]

# Expose HTTP/HTTPS ports
EXPOSE 80 443

ENTRYPOINT ["/usr/sbin/nginx"]

