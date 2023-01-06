window.addEventListener("keydown", checkKey, false);
window.onload = ajax;

function checkKey(key) {
  if (key.keyCode === 13) {
    answer();
  }
}
function wordToSpeech() {
  const phoneticAnswer = document.getElementById("phoneticAnswer");
  responsiveVoice.speak(phoneticAnswer.value, "Vietnamese Female");
}
function textToSpeech() {
  const text = document.getElementById("vietnameseText");
  responsiveVoice.speak(text.value, "Vietnamese Female", { rate: 0.75 });
}

function answer() {
  const userInput = document.getElementById("inputField");
  const correctAnswer = document.getElementById("answer");
  const phoneticAnswer = document.getElementById("phoneticAnswer");
  if (userInput.value === correctAnswer.value) {
    userInput.style.color = "black";
    userInput.style.backgroundColor = "lightgreen";
    userInput.value = phoneticAnswer.value;
    setTimeout(ajax, 1000);
  } else {
    userInput.style.color = "red";
    userInput.placeholder = phoneticAnswer.value;
    userInput.value = "";
  }
}

function ajax() {
  const correctAnswer = document.getElementById("answer");
  const phoneticAnswer = document.getElementById("phoneticAnswer");
  const sentence = document.getElementById("sentence");
  const englishWord = document.getElementById("englishWord");
  const englishText = document.getElementById("englishText");
  const vietnameseText = document.getElementById("vietnameseText");
  const id = document.getElementById("id");
  let xml = new XMLHttpRequest();
  xml.open("GET", "AJAX.php?id=" + id.innerHTML, true);
  xml.onload = function () {
    if (this.responseText === "400") {
      sentence.innerHTML = "Problem with connection. Error 400.";
    } else {
      let arr = JSON.parse(this.responseText);
      sentence.innerHTML = arr.vietnamese_text;
      correctAnswer.value = arr.simple_word;
      phoneticAnswer.value = arr.vietnamese_word;
      id.innerHTML = arr.id;
      englishWord.innerHTML = arr.english_word;
      englishText.innerHTML = arr.english_text;
      phoneticAnswer.value = arr.vietnamese_word;
      vietnameseText.value = arr.fullText;
    }
  };
  xml.send();
}
