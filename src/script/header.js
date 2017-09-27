var buttonUser = document.getElementById('user-menu-button');
var userMenu = document.getElementById('hidden-menu');

buttonUser.addEventListener("click",function(){
    userMenu.classList.toggle('hidden');
});
function vote (how,who,which,buttonCounter,buttonUp,buttonDown) {
      console.log(buttonUp)
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {    
            buttonCounter.innerHTML=this.responseText;  
          }
    };
    console.log('up',buttonUp);
    console.log('down',buttonDown)
    if(how==='up'){
          xmlhttp.open("POST", "src/procedures/voteUp.php", true);
          buttonUp.classList.remove("voted-down");
          buttonUp.classList.add("voted-up");
          buttonDown.classList.remove("voted-down");
          buttonDown.classList.remove("voted-up");     
    }else if(how==='down'){
          xmlhttp.open("POST", "src/procedures/voteDown.php", true);
          buttonDown.classList.remove("voted-up");
          buttonDown.classList.add("voted-down");
          buttonUp.classList.remove("voted-up");
          buttonUp.classList.remove("voted-down");
    };
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+who+"&memid="+which);
}