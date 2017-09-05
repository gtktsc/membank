var buttonUser = document.getElementById('user-menu-button');
var userMenu = document.getElementById('hidden-menu');

buttonUser.addEventListener("click",function(){
    userMenu.classList.toggle('hidden');
    console.log('menu')
})