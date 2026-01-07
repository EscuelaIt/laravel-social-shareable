import { LitElement, html, css } from 'lit';
import '@dile/iconlib/lucide-icons/share-2.js';
import '@dile/ui/components/menu-overlay/menu-overlay.js';

export class SocialShareable extends LitElement {
    static styles = [
        css`
            :host {
                display: block;
            }
            button {
                border: none;
                background-color: #1f9259;
                border-radius: 8px;
                padding: 10px;
                box-shadow: 0 2px 4px rgba(0, 0, 0, 0.4);
                --dile-icon-color: #fff;
                display: flex;
                align-items: center;
            }
        `
    ];

    render() {
        return html`
        <dile-menu-overlay verticalAlign="top">
            <button slot="trigger"><dile-lucide-icon-share-2></dile-lucide-icon-share-2></button>
            <div slot="content">
                <slot></slot>
            </div>
        </dile-menu-overlay>
        `;
    }
}
customElements.define('social-shareable', SocialShareable);
