<style>
    #social-shareable-widget-{{ $widgetId = uniqid() }} {
        position: fixed;
        bottom: 20px;
        right: 20px;
        z-index: 1000;
        background-color: #dedede;
        border-radius: 8px;
        padding: 10px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }
    #social-shareable-widget-{{ $widgetId }} .toggle-share {
        display: flex;
        align-items: center;
        justify-content: center;
    }
    #social-shareable-widget-{{ $widgetId }} .share-layer {
        margin-top: 10px;
    }
}
</style>
<div id="social-shareable-widget-{{ $widgetId }}">
    <button class="toggle-share">
        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-share2-icon lucide-share-2"><circle cx="18" cy="5" r="3"/><circle cx="6" cy="12" r="3"/><circle cx="18" cy="19" r="3"/><line x1="8.59" x2="15.42" y1="13.51" y2="17.49"/><line x1="15.41" x2="8.59" y1="6.51" y2="10.49"/></svg>
    </button>
    <div class="share-layer" style="display: none;">
        {{ $slot }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const widgets = document.querySelectorAll('[id^="social-shareable-widget-"]');
    widgets.forEach(widget => {
        const button = widget.querySelector('.toggle-share');
        const layer = widget.querySelector('.share-layer');
        button.addEventListener('click', function() {
            layer.style.display = layer.style.display === 'none' ? 'block' : 'none';
        });
    });
});
</script>
