function edit_saleprice_check(){
  //var fromdate=document.getElementsByName("fromdate")[0].value;
  //var nowdate=document.getElementsByName("nowdate")[0].value;
  // alert("だめです");
  // return false;
  console.log("aaaa");
  //console.log(nowdate);

//   if ( error ) {
    
//     return false;
//   } else {
    
//     return true;
// }
}

$(function(){
  // $(".send").prop("disabled",true);
  $("#fromdate").change(function(){
       console.log("aaaaaaa")
       var fromdate=document.getElementsByName("fromdate")[0].value;
      // var message=document.getElementsByName("honbun")[0].value;
      // if(message.length==0){
      //     $(".send").prop("disabled",true);
      // }else{
      //     $(".send").prop("disabled",false);
      // }
  });
});