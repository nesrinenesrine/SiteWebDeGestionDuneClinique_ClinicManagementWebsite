/*navbar mobile*/
const navMenu=document.getElementById('nav-menu');
const openMenu=document.getElementById('open-menu');
const closeMenu=document.getElementById('close-menu');
openMenu.addEventListener('click', () => {
  navMenu.classList.toggle('show')
} )
closeMenu.addEventListener('click', () => {
    navMenu.classList.remove('show')
  } )
/*auto play img slide*/
let counter = 1 ;
setInterval (function(){
  document.getElementById('radio' +counter).checked = true;
  counter++ ;
  if (counter > 4 ) {
    counter=1 ;
  }
} , 5000) ;


