/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 18.09.16.
 */
const Sequelize = require( 'sequelize' );
const config = require( '../config' );

class Instance {
    static instantiate() {
        return new Sequelize( config.mysql.database, config.mysql.username, config.mysql.password,
            {
                host: config.mysql.host,
                dialect: 'mariadb',
                pool: {
                    max: 5,
                    min: 0,
                    idle: 10000
                },
                define: {
                    timestamps: false,
                    underscored: true
                },
                logging: false,
            }
        );
    }
}

module.exports = Instance;