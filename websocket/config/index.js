/**
 * Created by aayaresko on 25.08.16.
 */

let fs = require('fs');
let ini = require('ini');
let data = ini.parse(fs.readFileSync('.env', 'utf-8'));

let config = {};

config.redis = {
    host: data['REDIS_HOST'],
    port: data['REDIS_PORT']
};

config.mysql = {
    host: data['DB_HOST'],
    database: data['DB_DATABASE'],
    username: data['DB_USERNAME'],
    password: data['DB_PASSWORD'],
    port: data['DB_PORT']
};

config.global = {
    env: 'development',
    secret: data['JWT_SECRET'],
    port: data['WEB_SOCKET_PORT'],
    author: {
        email: data['MAIL_FROM_ADDRESS'],
        name: data['MAIL_FROM_NAME'],
        url: 'https://github.com/aayaresko'
    },
    uploads_path: data['UPLOADS_PATH']
};

module.exports = config;