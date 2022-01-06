

function walkSync(currentDirPath, callback) {
    var fs = require('fs'),
        path = require('path');
    fs.readdirSync(currentDirPath).forEach(function (name) {
        var filePath = path.join(currentDirPath, name);
        var stat = fs.statSync(filePath);
        if (stat.isFile()) {
            callback(filePath, stat);
        } else if (stat.isDirectory()) {
            walkSync(filePath, callback);
        }
    });
}
walkSync('/content', function (filePath, stat) {
    console.log(filePath)
});

// var wkhtmltopdf = require('wkhtmltopdf');
// var fs = require('fs')

// var stream = wkhtmltopdf(fs.createReadStream('search.html'));
// console.log('stream: ', stream);


// const puppeteer = require('puppeteer')
 
// async function printPDF() {
//   const browser = await puppeteer.launch({ headless: true });
//   const page = await browser.newPage();
//   await page.goto('http://139.198.1.69:8080/pdf/compute/vm', {
//     timeout: 1000000,
//     waitUntil: 'networkidle2'});
//   const pdf = await page.pdf({ format: 'A4', path: './test.pdf'});
//   console.log('pdf: ', pdf);
//   await browser.close();
//   return pdf
// }
//  printPDF()


// const puppeteer = require('puppeteer');

// (async () => {
//     // Create an instance of the chrome browser
//     // But disable headless mode !
//     const browser = await puppeteer.launch({
//         headless: false
//     });

//     // Create a new page
//     const page = await browser.newPage();

//     // Configure the navigation timeout
//     await page.setDefaultNavigationTimeout(0);

//     // Navigate to some website e.g Our Code World
//     await page.goto('http://139.198.1.69:8080/pdf/compute/vm/');
//     const pdf = await page.pdf({ format: 'A4'});
//     console.log('pdf: ', pdf);
//     // Do your stuff
//     // ...
// })();

// const puppeteer = require('puppeteer');

// (async () => {
//     // Create an instance of the chrome browser
//     // But disable headless mode !
//     const browser = await puppeteer.launch({
//         headless: false
//     });

//     // Create a new page
//     const page = await browser.newPage();

//     // Configure the navigation timeout
//     await page.goto('http://139.198.1.69:8080/compute/vm/', {
//         waitUntil: 'load',
//         // Remove the timeout
//         timeout: 0
//     });

//     // Navigate to some website e.g Our Code World
//     await page.goto('http://139.198.1.69:8080/pdf/compute/vm/');
//     // const pdf = await page.pdf({ format: 'A4'});
//     // console.log('pdf: ', pdf);
//     // Do your stuff
//     // ...
// })();