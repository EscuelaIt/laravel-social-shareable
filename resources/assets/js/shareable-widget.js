import '../css/share-widget.css';
import './components/social-shareable.js';

document.addEventListener('DOMContentLoaded', function() {
    const widgets = document.querySelectorAll('.social-shareable-widget');
    widgets.forEach(widget => {
        const button = widget.querySelector('.toggle-share');
        const layer = widget.querySelector('.share-layer');
        button.addEventListener('click', function() {
            console.log('chick handler');
            layer.style.display = layer.style.display === 'none' ? 'block' : 'none';
        });
    });
});
