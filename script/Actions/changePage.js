$(document).ready(function(){

  //Script in comune alle pagine

  $("#esci").click(function(){
    $(document).load("../login.php");
  });

  $("ul#ulNav li a").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load(""+ page + ".php");
  });

  $("#linkCorso").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

  //Corsi -> Iscrizione al corso / Vai la corso (#linkCorso)

  $("div#divCorso a").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

  //Corso -> Materiali / Discussioni

  $("#nomeMateriale").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

  $("#nomeDiscussione").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

  /*$("ul#ulNav li a").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load(""+ page + ".php #" + page + "_content");
  });

  $("ul#isc li a").click(function(e){
    e.preventDefault();
    alert("adfgjadòkrjgòljk");
  });

  $("#linkCorso").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php #" + page + "_content");
  });*/

  //[name*='navCorsiComunicazioni']


});
