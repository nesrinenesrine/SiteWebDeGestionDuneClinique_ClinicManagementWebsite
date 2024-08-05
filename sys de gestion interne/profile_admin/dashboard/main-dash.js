window.onload =() => {
  const list3 =document.querySelectorAll('[data-dashboard]');
 
  for (let i=0 ; i<list3.length ; i++) {
    const list3_sw =list3[i];
    const dash_id=list3_sw.dataset.dash;
    list3_sw.addEventListener('click' ,() =>{
      document.querySelector('.lists .list.is-show').classList.remove('is-show');

      list3_sw.parentNode.classList.add('is-show');

      SwitchDash(dash_id);
    });
  }
}
function SwitchDash(dash_id) {
   const current_page =document.querySelector('.charts .chart.is-show');
   current_page.classList.remove ('is-show');
   const next_page =document.querySelector(`.charts .chart[data-charts="${dash_id}"]`);
   next_page.classList.add('is-show');
}

