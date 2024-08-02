// REDDIT SPACING
// This script will encrypt all of your messages if desired, and does so in a secure way.
// Provided by Owner of Https://Soyja.cc/

function clientaddon() {
let tr = document.createElement("tr");
let th = document.createElement("th");
let td = document.createElement("td");
let pass = document.createElement("input");
let enc2 = document.createElement("button");
let form = document.getElementsByName("post")[0].getElementsByTagName("table")[0];
pass.id = "pass";


if(window.location.href.includes("/res/")) {
th.innerText = "Decrypt";
tr.appendChild(th);
pass.name = "decode";
pass.type = "text";
pass.placeholder = "Enter the password here";
enc2.innerText = "Decrypt Post";
td.appendChild(pass);
td.appendChild(enc2);
tr.appendChild(th);
tr.appendChild(td);
form.appendChild(tr);
enc2.addEventListener("click", function() {
event.preventDefault();
    $.post("/crypt/crypt.php",
    {
      seed: pass.value,
      text: body.value,
      m:"x"
    },
    function(data,status){
if(!data) {
let small2 = document.createElement("small");
small2.style.color = "red";
small2.innerText = "The password was wrong.";
form.appendChild(small2);
form.appendChild(document.createElement("br"));
}
else {
body.value = data;
let small2 = document.createElement("small");
small2.style.color = "green";
small2.innerText = "Decrypted! \n All your posts will be \n auto-encrypted in this thread.";
form.appendChild(small2);
form.appendChild(document.createElement("br"));
localStorage.setItem("pass", pass.value);
localStorage.setItem("link", window.location.href);
location.reload();
}
    });});
}
else {
th.innerText = "Encrypt?";
tr.appendChild(th);
pass.name = "seed";
pass.type = "text";
pass.placeholder = "Enter a password here";
enc2.innerText = "Encrypt Post";
td.appendChild(pass);
td.appendChild(enc2);


tr.appendChild(th);
tr.appendChild(td);
form.appendChild(tr);
const body = document.getElementById("body");

enc2.addEventListener("click", function() {
event.preventDefault();
    $.post("/crypt/crypt.php",
    {
      seed: pass.value,
      text: body.value
    },
    function(data,status){
body.value = data;
    });});}

}

if(localStorage.getItem("link") != window.location.href) {
clientaddon();
}
else {
let tr = document.createElement("tr");
let th = document.createElement("th");
let td = document.createElement("td");
let enc3 = document.createElement("button");
let form = document.getElementsByName("post")[0].getElementsByTagName("table")[0];
enc3.innerText = "Reset password for this thread";
th.innerText = "Reset";
body.value = "";
tr.appendChild(th);
td.appendChild(enc3);
tr.appendChild(td);
form.appendChild(tr);
body.placeholder = "As soon as you click off this, your message will be encrypted.";
enc3.addEventListener("click", function() {
event.preventDefault();
localStorage.setItem("link", "");

location.reload();
});
}
let e ="0" ;
let x = "0";

if(window.location.href.includes("/res/")) {


let posts = document.getElementsByClassName("body");


  body.addEventListener("change", function() {
if(localStorage.getItem("link") == window.location.href) {
$.post("/crypt/crypt.php",
    {
      seed: localStorage.getItem("pass"),
      text: body.value,
      m:"x"
    },
    function(data,status){
body.value = data;

});
}
});

for(let i = 0; i < posts.length; i++) {
try {
console.log(i);
let p = posts[i].innerText;
    $.post("/crypt/crypt.php",
    {
      method: "d",
      text: posts[i].innerText,
      decode: localStorage.getItem("pass")
    },
    function(data,status){
      x = data;
 console.log(x);
let trip = data.split("|");
if(x.includes(trip[1]) && x.includes("\u{FFFD}") === false) {
 $.post("/crypt/crypt.php",
    {
      link: window.location.href,
      seed: localStorage.getItem("pass")
    },
    function(data,status){
console.log("Thread Marked");
});
posts[i].innerText = x.replaceAll("undefined","").replace(trip[1],"").replace("|","");
let small = document.createElement("small");
small.innerText = "[This post is encrypted]";
small.style.color = "green";
posts[i].appendChild(document.createElement("br"));
posts[i].appendChild(small);
} else {
let small = document.createElement("small");
small.innerText = "[This post is not encrypted, or uses another password]";
small.style.color = "red";
posts[i].appendChild(document.createElement("br"));
posts[i].appendChild(small);
   
}});}
catch(err) {
let small = document.createElement("small");
small.innerText = "["+err+"]";
small.style.color = "gray";
posts[i].appendChild(document.createElement("br"));
posts[i].appendChild(small);
}
}
};
