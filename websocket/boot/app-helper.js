/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 18.09.16.
 */

/**
 * Normalize a port into a number, string, or false.
 */
class AppHelper {
    static normalizePort( value ) {
        let port = parseInt( value, 10 );
        if (isNaN( port )) {
            return value;
        }
        if (port >= 0) {
            return port;
        }
        return false;
    }
}

module.exports = AppHelper;