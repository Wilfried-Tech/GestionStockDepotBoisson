/**
 * select an HTML element
 * @param {String} selector
 * @returns {HTMLElement}
 */
function $(selector) {
  return document.querySelector(selector);
}
/**
 * select all HTML element
 * @param {String} selector
 * @returns {Array<HTMLElement>}
 */
function $$(selector) {
  return document.querySelectorAll(selector);
}
/**
 * random Int between a and b
 * @param {Number} a
 * @param {Number} b
 * @returns {Number}
 */
function random(a, b) {
  return Math.floor(Math.random() * b + a);
}

/**
 * init Swipe Menu 
 */
function initSwipeMenu() {
  var menu = $('#menu')
  if (menu) {
    menu.addEventListener('click', (e) => {
      e.currentTarget.classList.toggle('active');
      e.currentTarget.style.setProperty('--menu-translationX', `${10+$('#nav-menu').offsetWidth-e.currentTarget.offsetWidth*2}px`);
      e.currentTarget.style.setProperty('--menu-translationY', '0');
    })
  }
}

function initMenuClickListener() {
  $$('.container-inner>article').forEach(elt => {
    elt.style.display = 'none';
  })
  $$('.nav-menu-item').forEach((elt, i) => {
    elt.addEventListener('click', () => {
      initSection(i + 1);
      if ($('#menu').classList.contains('active')) {
        $('#menu').click();
      }
    })
  })
  initSection(1);
}

function initSection(position) {
  $$('.container-inner>article').forEach((elt,i)=>{
    elt.style.display = (i == position-1)? 'block':'none';
  })
}
