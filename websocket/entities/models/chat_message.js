/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 25.08.16.
 */
const Sequelize = require( 'sequelize' );

class ChatMessage {
    constructor( database ) {
        this.database = database;
    }

    initialize() {
        return this.database.define( 'chat_message',
            {
                id: {
                    type: Sequelize.INTEGER,
                    autoIncrement: true,
                    primaryKey: true,
                    scopes: [ 'public' ]
                },
                content: {
                    type: Sequelize.TEXT,
                    scopes: [ 'public' ]
                },
                created_at: {
                    type: Sequelize.DATE,
                    defaultValue: Sequelize.NOW,
                    scopes: [ 'public' ]
                },
                updated_at: {
                    type: Sequelize.DATE
                }
            }
        );
    }
}

module.exports = ChatMessage;