/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 01.09.16.
 */
const Sequelize = require( 'sequelize' );

class AccountProfile {
    constructor( database ) {
        this.database = database;
    }

    initialize() {
        return this.database.define( 'account_profile',
            {
                id: {
                    type: Sequelize.INTEGER,
                    autoIncrement: true,
                    primaryKey: true
                },
                first_name: {
                    type: Sequelize.STRING
                },
                last_name: {
                    type: Sequelize.STRING
                },
                birth_date: {
                    type: Sequelize.DATE
                },
                avatar_url: {
                    type: Sequelize.STRING
                },
                created_at: {
                    type: Sequelize.DATE,
                    defaultValue: Sequelize.NOW
                },
                updated_at: {
                    type: Sequelize.DATE
                }
            },
            {
                freezeTableName: true,
            }
        );
    }
}

module.exports = AccountProfile;