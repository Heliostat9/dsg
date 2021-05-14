const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const roleScheme = new Schema({
    name: String
});

module.exports = mongoose.model('Role', roleScheme);