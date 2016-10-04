/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 18.09.16.
 */
const config = require('../config');

class Socket {
    constructor(database, port) {
        this.port = port;
        this.database = database;
        this.account = this.database.models.account;
        this.profile = this.database.models.account_profile;
        this.message = this.database.models.chat_message;
        this.container = {
            message: {},
        };
    }

    run() {
        const io = require('socket.io')(this.port);
        io.on('connection', (client) => {
            client.on('notification', (data) => {
                if (data.message.author_id) {
                    this.accountFindById(data.message.author_id).then((account) => {
                        this.container.message = data.message;
                        this.container.message.author = account.toJSON();
                        client.broadcast.emit('notify others', this.container);
                        // we store current user data in backup_container to use them, when and in case current user will be disconnected
                        let backup_container = Object.assign({}, this.container);
                        client.on('disconnect', () => {
                            // current user has been disconnected
                            // use a backup of current container which contains current user data
                            backup_container.message.content = ' has disconnected';
                            // notify other users
                            client.broadcast.emit('notify others', backup_container);
                        });
                    });
                }
            });
            client.on('chat message', (data) => {
                if (data.message.author_id) {
                    this.accountFindById(data.message.author_id).then((account) => {
                        account.createMessage(data.message).then((message) => {
                            let data = message.toJSON();
                            data.author = account.toJSON();
                            this.container.message = data;
                            io.emit('chat message', this.container);
                        });
                    }).catch((error) => console.log(error));
                }
            });
            // find 10 latest messages
            client.on('latest messages', (data) => {
                this.message.findAll({
                    where: {id: {$gt: data.index}},
                    include: [
                        {
                            model: this.account, as: 'author', include: [
                                {model: this.profile, as: 'profile'}
                            ]
                        }
                    ],
                    limit: 10,
                    order: [['created_at']]
                }).then((messages) => {
                    messages.forEach((message) => {
                        this.container.message = message.toJSON();
                        client.emit('chat message', this.container);
                    });
                }).catch((error) => console.log(error));
            });
        });
    }

    accountFindById(id) {
        return this.account.findById(id, {
            include: [
                {model: this.profile, as: 'profile'}
            ]
        });
    }
}

module.exports = Socket;