var buttonUser = document.getElementById('user-menu-button');
var userMenu = document.getElementById('hidden-menu');

buttonUser.addEventListener("click",function(){
    userMenu.classList.toggle('hidden');
});
function vote (how,who,which,buttonCounter,buttonUp,buttonDown) {
    var xmlhttp = new XMLHttpRequest();
    xmlhttp.onreadystatechange = function() {
          if (this.readyState == 4 && this.status == 200) {    
            buttonCounter.innerHTML=this.responseText;  
            console.log('lecim2',this.responseText,buttonCounter)
            
          }
    };
    if(how==='up'){
          xmlhttp.open("POST", "src/procedures/voteUp.php", true);
          buttonUp.classList.add("voted-up");
          buttonDown.classList.remove("voted-down");

    }else if(how==='down'){
          xmlhttp.open("POST", "src/procedures/voteDown.php", true);
          buttonDown.classList.add("voted-down");
          buttonUp.classList.remove("voted-up");


    };
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("user="+who+"&memid="+which);
}