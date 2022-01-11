const express = require('express');
const app = express();
const bodyParser = require('body-parser');
const path = require('path')
const fs = require('fs')
//处理接收request对象的大小限制
app.use(bodyParser.json({
  limit: '50mb'
}));

//处理接收request对象的大小限制
app.use(bodyParser.urlencoded({
  limit: '50mb',
  parameterLimit: 100000,
  extended: true 
}));

app.all("/*", function(req, res, next) {
  // 跨域处理
  res.header("Access-Control-Allow-Origin", "*");
  res.header('Access-Control-Allow-Headers', 'Content-Type, Content-Length,   Authorization, Accept, X-Requested-With , yourHeaderFeild');
  res.header("Access-Control-Allow-Methods", "PUT,POST,GET,DELETE,OPTIONS");
  res.header("X-Powered-By", ' 3.2.1');
  res.header("Content-Type", "application/json;charset=utf-8");
  next(); // 执行下一个路由
});

app.use('/static', express.static(path.join(__dirname, 'public')));

app.get("/home", function(req, res) {
  res.send("!");
});
    app.get('/test', function(req, res) {
            fs.readFile(__dirname + '/public/pdf/pdf.html', 'utf8', function(err, text){
                res.send(text);
            });
        })
app.listen(8787,()=>{
  console.log('服务端开启在8787端口');
});
