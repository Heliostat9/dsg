const express = require('express');
const mongoose = require('mongoose');

const router = express.Router();

const User = require('../models/User');
const Role = require('../models/Role');
const City = require('../models/City');
const Order = require('../models/Order');
const New = require('../models/New');

const createReport = require('docx-templates');
const fs = require('fs');
const path = require('path');

router.get('/news', async (req, res) => {
    const result = await New.find();
    console.log(result);
    return res.send(result);
});

router.post('/update-status', async (req, res) => {
    let status = req.body.status;

    const result = await Order.updateOne({_id: mongoose.Types.ObjectId(req.body.id)}, {status: status});

    return res.send(result);
});

router.get('/is-login', async (req, res) => {

    let result = await User.findById({_id: mongoose.Types.ObjectId(req.session.idi)}).populate('status').populate('city');

    let isLogin = {
        stat: req.session.isLogin ? true : false,
        role: result.status.name,
        city: result.city.name
    }

    return res.json(isLogin);
});

router.post('/login', async (req, res) => {
    const result = await User.find({login: req.body.login, pass: req.body.password});

    if (!result.length) {
        return res.redirect('/login');
    }

    req.session.isLogin = true;
    req.session.idi = result[0]._id;
    console.log(req.session.idi);
    return res.redirect('/profile');
});

router.post('/register', async (req, res) => {
    let user = new User({
        login: req.body.login,
        pass: req.body.password,
        name: req.body.first_name,
        last_name: req.body.last_name,
        middle_name: req.body.middle_name,
        city: mongoose.Types.ObjectId(req.body.city),
        status: "607bde1d60a1c0d6ea86071b"
    });

    user.save();

    res.redirect('/login');
});

router.get('/logout', (req, res) => {
    req.session.destroy();

    return res.redirect('/');
});

router.get('/get-credit/:id', async (req, res) => {
    const id = req.params.id;

    const result = await Order.findById({_id: mongoose.Types.ObjectId(id)});

    return res.json(result);
})

router.get('/get-credits', async (req, res) => {
    let result = await Order.find();

    return res.json(result);
});

router.get('/get-user', async (req, res) => {
    console.log(req.session.idi);
    let result = await User.findOne({_id: mongoose.Types.ObjectId(req.session.idi)}).populate('status').populate('city');

    return res.json(result);
    
});

router.get('/print/:id', async (req, res) => {
    let result = await Order.findOne({_id: mongoose.Types.ObjectId(req.params.id)}).populate({
        path: 'idClient',
        populate: {
            path: 'city'
        }
    });
    const template = fs.readFileSync('./dogovor-credit.docx');
    
    const buffer = await createReport.createReport({
        template,
        data: {
            id: result._id,
            day: new Date().toLocaleDateString(),
            city: result.idClient.city.name,
            name: result.idClient.name,
            middle_name: result.idClient.middle_name,
            last_name: result.idClient.last_name,
            sumCredit: result.sumCredit,
            target: result.target,
            
        }
    });

    fs.writeFileSync(req.params.id + '.docx', buffer);

    res.sendFile(path.join(__dirname, '../', req.params.id + '.docx'));
});


router.post('/add-order/', async (req, res) => {
    console.log(req.body.clientId);
    const order = new Order({
        idClient: mongoose.Types.ObjectId(req.body.clientId),
        sumCredit: req.body.sumCredit[0],
        timeCredit: req.body.timeCredit,
        monthPay: req.body.monthPay,
        target: req.body.target,
        tel: req.body.tel,
        email: req.body.email,
        seriesPass: req.body.seriesPass,
        numberPass: req.body.numberPass,
        codePass: req.body.codePass,
        date:req.body.date,
        inn: req.body.inn,
        fromPass: req.body.fromPass,
        index: req.body.index,
        street: req.body.street,
        house: req.body.house,
        status: 'В обработке',
    });

    order.save();
    
    return res.redirect('/profile');
});

router.post('/createNews', async (req, res) => {
    let news = new New({
        title: req.body.title,
        description: req.body.desc,
        src: req.body.url,
        date: new Date()
    });

    news.save();

    return res.redirect('/news');
});

router.get('/news/del/:id', async (req, res) => {
    await New.remove({_id: mongoose.Types.ObjectId(req.params.id)});

    return res.redirect('/');
}); 

router.get('/get-users/', async (req, res) => {
    let result = await User.find().populate('status').populate('city');

    return res.json(result);
});

module.exports = router;