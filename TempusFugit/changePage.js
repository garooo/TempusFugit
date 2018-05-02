$(document).ready(function(){
    
  //index.php
    
  $("div#ultimaComunicazione a").click(function(e){
      e.preventDefault();
      var page= $(this).attr("href");
      $("#content").load("" + page + ".php");
  });
    
  //Script in comune alle pagine

  $("ul#ulNav li a").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load(""+ page + ".php");
  });

  //Corsi -> Iscrizione al corso / Vai la corso (#linkCorso)

  $("div#divCorso a").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

  //Corso -> Discussioni

  $("#nomeDiscussione").click(function(e){
    e.preventDefault();
    var page= $(this).attr("href");
    $("#content").load("" + page + ".php");
  });

});
