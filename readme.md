[linuxserverurl]: https://linuxserver.io
[![linuxserver.io](https://raw.githubusercontent.com/linuxserver/docker-templates/master/linuxserver.io/img/linuxserver_medium.png)][linuxserverurl]

## About Argus

Argus is designed as a simple, user friendly front end to complicated NVR setups.

It currently has support for ZoneMinder as the backend, but any backend with an API could be implemented.

More to come


## Requirements
* Node
* PHP 5.6+
* Composer

## Install via Docker

Easiest way to install is with docker

docker create --name=argus -p 8765:80 -v /Users/admin/Docker/argus:/config -e PGID=80 -e PUID=501 linuxserver/argus

Replace 8765 with whatever port you want to be able to hit it on.
Replace /Users/admin/Docker/argus with wherever you want to store the persistant settings
Replace PGID and PUID with whatever is appropriate for your system, if you type `id` in terminal you can determine what is suitable for you

After it has downloaded type:

`docker start argus`

Then you should be able to hit it at something like http://127.0.0.1:8765

## Manual Installation

web root should be pointed to /path/to/app/public

cd to /path/to/app and run:

`npm install` (for development tools)
`composer install`

Create a .env in /path/to/app with the contents of https://pastebin.com/mGNGjXbq

run:
`php artisan key:generate`

More to come 

<p align="center"><img src="http://i.imgur.com/I06gwJU.png"></p>
