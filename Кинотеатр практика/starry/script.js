// script.js
document.querySelector('nav ul').addEventListener('mouseover', function() {
    this.style.backgroundColor = '#ddd';
});

document.querySelector('nav ul').addEventListener('mouseout', function() {
    this.style.backgroundColor = '';
});