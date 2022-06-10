<!-- Js File_________________________________ -->

<!-- bootstrap -->
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>

        <!-- jQuery UI library -->
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>

        <script type="text/javascript">
$(function(){
              $('#Source').autocomplete({
                          source:"autocomplete.php",
                          select:function(event,ui){
                              event.preventDefault();
                              $('#Source').val(ui.item.id);
                              console.log(ui.item.value);
                          }
                      });
          });
  $(function(){
                $('#Destination').autocomplete({
                            source:"autocomplete.php",
                            select:function(event,ui){
                                event.preventDefault();
                                $('#Destination').val(ui.item.id);
                                console.log(ui.item.value);
                            }
                        });
            });
</script>

<!-- j Query -->
<script type="text/javascript" src="vendor/jquery.2.2.3.min.js"></script>
<!-- Bootstrap JS -->
<script type="text/javascript" src="vendor/bootstrap/bootstrap.min.js"></script>
<script src="jump.js"> </script>
</div>
<!-- /.main-page-wrapper -->
</body>

</html>
