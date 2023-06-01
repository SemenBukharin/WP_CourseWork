function passwordCheck(){
    if (document.getElementById('inputPassword').value != document.getElementById('repeatPassword').value)
      {
        document.getElementById('passwordCheck').textContent='Пароли не совпадают!';
        return false;
      }
    else
      {
        document.getElementById('passwordCheck').textContent='';
        return true;
      }
}

function setCity()
{

  let cityId = document.getElementById("selectedCity").value;

  var xhttp;
  xhttp = new XMLHttpRequest();

  xhttp.open("GET", "vendor/setCity.php?q="+cityId, true);
  xhttp.send();
  location.reload();
}

function tryToSignUpForAnEvent()
{
  let params = (new URL(document.location)).searchParams;
  let eventId = params.get("event");

  var xhttp;

  xhttp = new XMLHttpRequest();

  xhttp.onreadystatechange = function() {
    if (this.readyState == 4 && this.status == 200) {
      if (this.responseText=="0"){
        document.getElementById("placesCount").innerHTML = "Вы не авторизованы!";
      }
      else {
        document.getElementById("placesCount").innerHTML = "Число участников: " + this.responseText;
        if (this.responseText!="Мест нет!"){
          if (document.getElementById("btnText").innerHTML == "Участвовать!"){
            document.getElementById("btnText").innerHTML = "Отменить участие.";
          }
          else {
            document.getElementById("btnText").innerHTML = "Участвовать!";
            }
         }
      }

    }
  };

  xhttp.open("GET", "vendor/tryToSignUpForAnEvent.php?q="+eventId, true);
  xhttp.send();
}

function unlockDeleteImageBtn(input){
  input.nextElementSibling.classList.toggle("v-hidden");
}

function clearInput(btn){
  btn.previousElementSibling.value="";
  btn.classList.toggle("v-hidden");
}

function changeMaxWidth(){
        if (window.innerWidth>1361){
          document.getElementById("flexTrouble").removeAttribute("style");
          document.getElementById("flexTrouble").setAttribute("style", "max-width:251px");
        }
        else {
          document.getElementById("flexTrouble").removeAttribute("style");
          document.getElementById("flexTrouble").setAttribute("style", "max-width:502px");
        }
      }