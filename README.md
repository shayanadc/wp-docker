## run docker container
``` docker-compose up --build -d ```

## import database

``` docker exec -i mysql_container mysql -u root -p secret mysql < db.sql ```
### Or
import database ``` db/wp_host4.sql ``` with phpmyadmin
