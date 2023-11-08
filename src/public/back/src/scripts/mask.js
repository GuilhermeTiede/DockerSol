const Cleave = require('cleave.js');

document.addEventListener('DOMContentLoaded', function () {
    new Cleave('#cnpj', {
        delimiters: ['.', '.', '/', '-'],
        blocks: [2, 3, 3, 4, 2],
        uppercase: true
    });
});
