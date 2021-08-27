export default class Offcanvas {
  constructor() {
    const bodyElement = document.getElementsByTagName('body')[0];

    // TOGGLE OFF CANVAS
    const offCanvasToggles = document.querySelectorAll('.off-canvas-toggle');
    offCanvasToggles.forEach((offCanvasToggle) => {
      offCanvasToggle.addEventListener('click', (e) => {
        bodyElement.classList.toggle('off-canvas-active');
        e.preventDefault();
      });
    });
  }
}
