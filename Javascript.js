window.addEventListener("keydown", checkKey, false);
var ans = false;
function checkKey(key) {
   if (key.keyCode === 13) {
      if (ans === false) {
         answer();
      }
      else
         location.reload();
   }
}

function wordToSpeech() {
   const phoneticAnswer = document.getElementById('phoneticAnswer');
   responsiveVoice.speak(phoneticAnswer.value, "Vietnamese Female");
}
function textToSpeech() {
   const text = document.getElementById('vietnameseText');
   responsiveVoice.speak(text.value, "Vietnamese Female", { rate: 0.75 });
}

function answer() {
   const userInput = document.getElementById('inputField');
   const correctAnswer = document.getElementById('answer');
   const phoneticAnswer = document.getElementById('phoneticAnswer');
   const englishText = document.getElementById('englishText');
   document.getElementById("englishText").style.display = "inline";
   englishText.style.display = "inline";
   if (userInput.value === correctAnswer.value) {
      userInput.style.color = "black";
      userInput.style.backgroundColor = "lightgreen";
      userInput.value = phoneticAnswer.value;
      ans = true;
      setTimeout(function() { location.reload() }, 750);
   }
   else {
      userInput.style.color = "red";
      userInput.placeholder = phoneticAnswer.value;
      userInput.value = "";
   }
}
