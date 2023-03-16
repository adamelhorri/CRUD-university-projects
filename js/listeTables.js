const arrow = document.getElementById('arrow')
const sideBar = document.getElementById('side-bar')

arrow.addEventListener('click', () => {
  if(sideBar.hasAttribute('opened')){
    arrow.classList.remove('rotate-180')
    sideBar.removeAttribute('opened')
    sideBar.classList.add('translate-100')
  }
  else{
    arrow.classList.add('rotate-180')
    sideBar.setAttribute('opened', '')
    sideBar.classList.remove('translate-100')
  }
})