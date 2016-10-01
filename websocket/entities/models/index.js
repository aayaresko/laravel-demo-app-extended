/*
 * Copyright (c) 2016  Andrey Yaresko.
 */

/**
 * Created by aayaresko on 18.09.16.
 */
class ModelsLoader {
    constructor( database ) {
        this.database = database;
        this.initialize();
    }

    initialize() {
        let ModelClass;
        ModelClass = require( './account' );
        const Account = new ModelClass( this.database ).initialize();
        ModelClass = require( './account_profile' );
        const AccountProfile = new ModelClass( this.database ).initialize();
        ModelClass = require( './chat_message' );
        const ChatMessage = new ModelClass( this.database ).initialize();

        Account.hasOne(AccountProfile, { as: 'profile', foreignKey: 'account_id' });
        Account.hasMany(ChatMessage, { as: 'messages', foreignKey: 'author_id' });
        AccountProfile.belongsTo(Account, { as: 'account', foreignKey: 'account_id' });
        ChatMessage.belongsTo(Account, { as: 'author', foreignKey: 'author_id' });

        return {
            Account: Account,
            AccountProfile: AccountProfile,
            ChatMessage: ChatMessage
        }
    }
}

module.exports = ModelsLoader;