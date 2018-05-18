<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <title>jQuery UI Button - Split button</title>
  <link rel="stylesheet" href="css/jquery-ui.css">
  <script src="js/jquery-1.10.2.js"></script>
  <script src="js/jquery-ui.js"></script>
  <style>
    .ui-menu { position:relative; width: 100px; }
  </style>
  <script>
  $(function() {
    $( "#rerun" )
      .button()
      .click(function() {
        alert( "Clicou para mostrar o alert" );
      })
      .next()
        .button({
          text: false,
          icons: {
            primary: "ui-icon-triangle-1-s"
          }
        })
        .click(function() {
          var menu = $( this ).parent().next().show().position({
            my: "right top",
            at: "right bottom",
            of: this
          });
          $( document ).one( "click", function() {
            menu.hide();
          });
          return false;
        })
        .parent()
          .buttonset()
          .next()
            .hide()
            .menu();
  });
  </script>
</head>
<body>
 
<div>
  <div>
    <button id="rerun">Run last action</button>
    <button id="select">Select an action</button>
  </div>
  <ul>
    <li>Open...</li>
    <li>Save</li>
    <li>Delete</li>
  </ul>
</div>
 
 
</body>
</html>