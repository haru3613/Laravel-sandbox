## About laradock

- 把Laradock放置在專案同層目錄中
- cp Laradock的env file
- cp apache2 *.config file，並加上project path
- sudo vim /etc/hosts修改domain name
- 修改mysql database name或其他設定須清空cache
```
# stop mysql service
docker-compose stop mysql
# delete old mysql database
rm -rf ~/.laradock/data/mysql
# resetup mysql container
docker-compose up -d mysql
```
