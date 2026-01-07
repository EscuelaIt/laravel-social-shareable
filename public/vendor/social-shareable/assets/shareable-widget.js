import { LitElement as n, css as r, html as i } from "lit";
import "@dile/iconlib/lucide-icons/share-2.js";
import "@dile/ui/components/menu-overlay/menu-overlay.js";
class s extends n {
  static styles = [
    r`
            :host {
                display: block;
            }
            button {
                border: none;
                background-color: #f24545;
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
    return i`
        <dile-menu-overlay verticalAlign="top">
            <button slot="trigger"><dile-lucide-icon-share-2></dile-lucide-icon-share-2></button>
            <div slot="content">
                <slot></slot>
            </div>
        </dile-menu-overlay>
        `;
  }
}
customElements.define("social-shareable", s);
document.addEventListener("DOMContentLoaded", function() {
  document.querySelectorAll(".social-shareable-widget").forEach((e) => {
    const l = e.querySelector(".toggle-share"), o = e.querySelector(".share-layer");
    l.addEventListener("click", function() {
      console.log("chick handler"), o.style.display = o.style.display === "none" ? "block" : "none";
    });
  });
});
