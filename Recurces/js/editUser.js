var formName=document.getElementById('formEditName');
var formPass=document.getElementById('formEditPass');
var formMail=document.getElementById('formEditMail');
formName.addEventListener('submit',function (e) {
    e.preventDefault();
    var obj = new Send('User',formName,'edit','name_user');  
});
formPass.addEventListener('submit',function (e) {
    e.preventDefault();
    var obj = new Send('User',formPass,'edit','password_user');  
});
formMail.addEventListener('submit',function (e) {
    e.preventDefault();
    var obj = new Send('User',formMail,'edit','email');  
});