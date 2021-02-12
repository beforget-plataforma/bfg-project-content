const tabInitFunction = function() {
  const objectNav = document.querySelector('#object-nav')
  const buttonTabs = objectNav.querySelectorAll('.bfg-nav-project')
  const bfgtabs = document.querySelector('.bfg-tabs')

  for (let index = 0; index < buttonTabs.length; index++) {
    const element = buttonTabs[index];
    element.addEventListener('click', function(e){
      e.preventDefault()
      const attr = this.getAttribute('data-tab-id')
      for (let index = 0; index < bfgtabs.querySelectorAll('.bfg-project-content').length; index++) {
        bfgtabs.querySelectorAll('.bfg-project-content')[index].classList.add('bfg-hidden');
        buttonTabs[index].parentElement.classList.remove('selected');
      }
      bfgtabs.querySelector('#' + attr).classList.remove('bfg-hidden');
      this.parentElement.classList.add('selected')
    })
  }

  // Button Contacto
  if(document.querySelector('#bfg-button-primary') !== null){
    document.querySelector('#bfg-button-primary').addEventListener('click', function(){
      bfgtabs.querySelectorAll('.bfg-project-content')[0].classList.add('bfg-hidden');
      bfgtabs.querySelectorAll('.bfg-project-content')[1].classList.remove('bfg-hidden');
      buttonTabs[0].parentElement.classList.remove('selected');
      buttonTabs[1].parentElement.classList.add('selected');
  
  
      // document.querySelector('.bfg-form-contact-project').classList.remove('bfg-hidden')
      // window.scrollTo({
      //   top: (document.querySelector("#tabs-1 > div.bfg-form-contact-project").offsetTop) - 30,
      //   behavior: 'smooth'
      // });
    })
  };
}

document.addEventListener('DOMContentLoaded', function(){
  tabInitFunction()
})