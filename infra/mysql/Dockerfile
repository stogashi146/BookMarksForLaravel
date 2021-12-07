FROM mysql/mysql-server:8.0@sha256:b1722efc37f6bfed64b70d80139d18fdd89a68b545ebeedaf00dec4672de9c69

ENV MYSQL_DATABASE=bookmarks \
  MYSQL_USER=phper \
  MYSQL_PASSWORD=secret \
  MYSQL_ROOT_PASSWORD=secret \
  TZ=Asia/Tokyo

COPY infra/mysql/my.cnf /etc/my.cnf
RUN chmod 644 /etc/my.cnf
# RUN "mysql -u root -p${MYSQL_PASSWORD} ${MYSQL_DATABASE}"
# RUN "GRANT ALL ON *.* TO ${PMA_USER};"
