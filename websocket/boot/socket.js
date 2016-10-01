/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 18.09.16.
 */
const config = require('../config');
const socketioJwt = require('socketio-jwt');

class Socket {
    constructor(database, port) {
        this.database = database;
        this.port = port;
        this.account = this.database.models.account;
        this.profile = this.database.models.account_profile;
        this.message = this.database.models.chat_message;
        this.container = {
            account: null,
            options: {
                uploads_path: config.global.uploads_path
            }
        };
        this.containers = [];
    }

    run() {
        const io = require('socket.io')(this.port);
        io.use(socketioJwt.authorize({
                secret: config.global.secret,
                timeout: 1500, // 15 seconds to send the authentication message
                handshake: true, // validate token on handshake
                callback: false // No client-side callback, terminate connection server-side
            })
        );
        io.on('connection', client => {
            console.log('user connected');
            let token = client.decoded_token;
            // first of all lets find current account model
            this.findAccountById(token.id).then((account) => {
                if (account) {
                    this.container.account = account.toJSON();
                    this.container.message = {content: 'has joined', author_id: account.id};
                    client.emit('user account', this.container);
                    client.broadcast.emit('notify others', this.container);
                    // Since there is no possibility to send message when user model is not defined
                    // we will attach 'chat message' and 'user disconnected' event listeners only after that model have been defined
                    client.on('chat message', (data) => {
                        account.createMessage(data.message).then((message) => {
                            this.container.account = account.toJSON();
                            this.container.message = message.toJSON();
                            // send message to all users
                            io.emit('chat message', this.container);
                        });
                    });
                    client.on('disconnect', () => {
                        this.container.account = account.toJSON();
                        this.container.message = {content: 'has left', author_id: this.container.account.id};
                        client.broadcast.emit('notify others', this.container);
                        console.log('user disconnected');
                    });
                }
            });
            // find 10 latest messages
            client.on('latest messages', (data) => {
                this.message.findAll({
                    where: {
                        id: {
                            $gt: data.index
                        }
                    },
                    include: [
                        {model: this.account, as: 'author', include: [{model: this.profile, as: 'profile'}]}
                    ],
                    limit: 10,
                    order: [['created_at']]
                }).then((messages) => {
                    messages.forEach((message) => {
                        this.container.account = message.author.toJSON();
                        this.container.message = message.toJSON();
                        delete this.container.message.author;
                        client.emit('chat message', this.container);
                    });
                });
            });
        });
    }

    findAccountById(id) {
        return this.account.findById(id, {
            include: [
                {model: this.profile, as: 'profile'}
            ]
        });
    }
}

module.exports = Socket;