let list =document.querySelectorAll('.nav li');

function activeLink () {
  
  list.forEach((item) => {
    item.classList.remove ('hovered')

  }
   
  );
  this.classList.add('hovered');
}
  list.forEach((item)=> 
  item.addEventListener('click' ,activeLink));



let list2 =document.querySelectorAll('[data-switcher]');

function activeMain () {
  
  list2.forEach((item) => 
    item.classList.remove ('is-active'));

  this.classList.add('is-active');
  const main_id=this.dataset.tab;
  console.log(main_id);
  SwitchPage(main_id);
  
  
}
list2.forEach((item)=> 
item.addEventListener('click' ,activeMain));

function SwitchPage(main_id) {
   const current_page =document.querySelector('.mains .main.is-active');
   current_page.classList.remove ('is-active');
   const next_page =document.querySelector(`.mains .main[data-main="${main_id}"]`);
   next_page.classList.add('is-active');
}
 








let toggle =document.querySelector ('.toggle') ;
let nav =document.querySelector ('.nav') ;
let main =document.querySelector ('.main') ;

toggle.onclick = function () {
  nav.classList.toggle('active');
  main.classList.toggle('active');
  
}

