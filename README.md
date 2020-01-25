# rss-reader

The RSS reader

Based on: Slim Framework 4 Skeleton Application


## Install the Application

Install required dependencies

```bash
cd [my-app-name]
composer install
```

Create environment configurations:
- create environent configuration file as in `.env.sample` example file
- set same database configurations in `docker-compose.yml`
- ensure that you have `./database` directory and it is writable
- run project with `docker-compose`

Or you can use `docker-compose` to run the app with `docker`, so you can run these commands:
```bash
cd [my-app-name]
docker-compose up -d
```
After that, open `http://localhost:8080` in your browser.
