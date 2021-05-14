const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const userScheme = new Schema({
    login: String,
    pass: String,
    name: String,
    last_name: String,
    middle_name: String,
    status: {
        ref: 'Role',
        type: Schema.Types.ObjectId
    },
    city: {
        ref: 'City',
        type: Schema.Types.ObjectId
    }
})

module.exports = mongoose.model('User', userScheme);