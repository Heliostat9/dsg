const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const newScheme = new Schema({
    title: String,
    description: String,
    src: String,
    date: Date
});

module.exports = mongoose.model('New', newScheme);