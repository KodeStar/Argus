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

## Installation

web root should be pointed to /path/to/app/public

cd to /path/to/app and run:

`npm install` (for development tools)
`composer install`

Create a .env in /path/to/app with the contents of https://pastebin.com/mGNGjXbq

run:
`php artisan key:generate`

More to come 

<p align="center"><img src="http://i.imgur.com/I06gwJU.png"></p>
