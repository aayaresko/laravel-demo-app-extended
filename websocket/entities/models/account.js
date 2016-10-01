/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 25.08.16.
 */
const Sequelize = require( 'sequelize' );

class Account {
    constructor( database ) {
        this.database = database;
    }

    initialize() {
        return this.database.define( 'account',
            {
                id: {
                    type: Sequelize.INTEGER,
                    autoIncrement: true,
                    primaryKey: true
                },
                nickname: {
                    type: Sequelize.STRING,
                    unique: true
                },
                email: {
                    type: Sequelize.STRING,
                    unique: true
                },
                status: {
                    type: Sequelize.INTEGER
                },
                created_at: {
                    type: Sequelize.DATE,
                    defaultValue: Sequelize.NOW
                },
                updated_at: {
                    type: Sequelize.DATE
                }
            }
        );
    }
}

module.exports = Account;