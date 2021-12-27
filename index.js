

// function walkSync(currentDirPath, callback) {
//     var fs = require('fs'),
//         path = require('path');
//     fs.readdirSync(currentDirPath).forEach(function (name) {
//         var filePath = path.join(currentDirPath, name);
//         var stat = fs.statSync(filePath);
//         if (stat.isFile()) {
//             callback(filePath, stat);
//         } else if (stat.isDirectory()) {
//             walkSync(filePath, callback);
//         }
//     });
// }
// walkSync('src', function (filePath, stat) {
//     console.log(filePath)

// });

var wkhtmltopdf = require('wkhtmltopdf');
var fs = require('fs')

var stream = wkhtmltopdf(fs.createReadStream('search.html'));
console.log('stream: ', stream);