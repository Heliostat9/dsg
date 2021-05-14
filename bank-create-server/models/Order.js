const mongoose = require('mongoose');

const Schema = mongoose.Schema;

const orderScheme = new Schema({
    idClient: {
        ref: 'User',
        type: mongoose.Types.ObjectId
    },
    sumCredit: Number,
    timeCredit: Number,
    monthPay: Number,
    target: String,
    tel: String,
    email: String,
    seriesPass: String,
    numberPass: String,
    codePass: String,
    date: Date,
    inn: String,
    fromPass: String,
    index: String,
    street: String,
    house: String,
    status: String
})

module.exports = mongoose.model('Order', orderScheme);