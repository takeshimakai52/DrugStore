function myfunc(){
  var errorMessage = document.getElementById('errorMessage');
  var account = document.getElementsByName('account');
  var password = document.getElementsByName('password');
  var buf_errorMessage = null;
  if(account[0].value == '' && password[0].value !== ''){
    buf_errorMessage = 'ログインIDが入力されていません';
  }else if(account[0].value !== '' && password[0].value == ''){
    buf_errorMessage = 'パスワードが入力されていません';
  }else if(account[0].value == '' && password[0].value == ''){
    buf_errorMessage = 'ログインIDとパスワードが入力されていません';
  }
  if(buf_errorMessage == null){
    document.myform.submit();
  }
  errorMessage.innerHTML = buf_errorMessage;
}
