function changebrand(){
  var makerid = document.getElementsByName('itemmaker')[0].value;
  var tagoption = "brandoption"+makerid;
  if(makerid==""){
    $("select#brandselect").attr("selected", false);
    $("sselect#brandselect").val('');
    //$("select#brandselect option[name='misentaku']").prop("selected",true);
    $("#brandselect option").attr("disabled", "disabled");
    console.log("misenntaku");
  }else{
    //$("select#brandselect").prop("disabled",true);
    //$("#brandselect").children("[value='']").prop("selected",true);
    $("select#brandselect").attr("selected", false);
    $("sselect#brandselect").val('');
    //$("select#brandselect option[name='misentaku']").prop("selected",true);
    $("#brandselect option").attr("disabled", "disabled");
    $("select#brandselect option[name='" + tagoption + "']").prop("disabled",false);
  }
  // console.log(tagoption);
  // $('select[name="itembrand"]').prop("disabled",true);
  // $(".send").prop("disabled",true);
  // $('select#brandselect option[value="1"]').prop("disabled",true);
  console.log($("select#brandselect option[name='" + tagoption + "']").val());
  //$("select#brandselect").prop("disabled",true);
  //$("select#brandselect option[name='" + tagoption + "']").prop("disabled",false);

}