function genre_newempty(){
  var genrebox = document.getElementById("genre").value;
  if (genrebox == 0) {
    alert('ジャンル名を入力してください');
  }else if(genrebox !== 0){
    var genre = confirm('本当に登録しますか？');
    if(genre == true){
      document.forms.genreconfirm.submit();
    }
  }
}
function genre_editempty(){
  var genre_editbox = document.getElementById("genre_edit").value;
  if (genre_editbox == 0) {
    alert('ジャンル名を入力してください');
  }else if(genre_editbox !== 0){
    var genre_edit = confirm('本当に変更しますか？');
    if(genre_edit == true){
      document.forms.genreeditconfirm.submit();
    }
  }
}
function maker_newempty(){
  var makerbox = document.getElementById("maker").value;
  if (makerbox == 0){
    alert('メーカー名を入力してください');
  }else if(makerbox !== 0){
    var maker = confirm('本当に登録しますか？');
    if(maker == true){
    document.forms.makerconfirm.submit();
  }
}
}
function maker_editempty(){
  var maker_editbox = document.getElementById("maker_edit").value;
  if (maker_editbox == 0){
    alert('メーカーを選択してください');
  }else if(maker_editbox !== 0){
    var maker_edit = confirm('本当に変更しますか？');
    if(maker_edit == true){
      document.forms.makereditconfirm.submit();
    }
  }
}
function brand_newempty(){
  var brandbox = document.getElementById("brand").value;
  if (brandbox == 0){
    alert('ブランド名を入力してください');
  }else if(brandbox !== 0){
    var brand = confirm('本当に登録しますか？');
    if(brand == true){
    document.forms.brandconfirm.submit();
  }
}
}
function brand_editempty(){
  var brand_editbox = document.getElementById("brand_edit").value;
  if (brand_editbox == 0){
    alert('ブランド名を入力してください');
  }else if(brand_editbox !== 0){
    var brand_edit = confirm('本当に変更しますか？');
    if(brand_edit == true){
      document.forms.brandeditconfirm.submit();
    }
  }
}
