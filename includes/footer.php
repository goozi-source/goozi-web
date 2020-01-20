<footer class="page-footer text-center font-small mt-4 wow fadeIn fixed-bottom" id="footer">
    <!--Copyright-->
    <div class="footer-copyright py-3">
      © 2019 Copyright:
      <a href="#"> <?= AppName() ?> </a>
    </div>
    <!--/.Copyright-->
</footer>
  <!--/.Footer-->
</body>
<script src="/register.js"></script>
<!-- SCRIPTS -->
<!-- JQuery -->
<script type="text/javascript" src="/js/jquery-3.3.1.min.js"></script>
<!-- Bootstrap tooltips -->
<script type="text/javascript" src="/js/popper.min.js"></script>
<!-- Bootstrap core JavaScript -->
<script type="text/javascript" src="/js/bootstrap.min.js"></script>
<!-- MDB core JavaScript -->
<script type="text/javascript" src="/js/mdb.min.js"></script>
      <!-- Initializations -->
<script type="text/javascript">
// Animations initialization
new WOW().init();
</script>
<script>
$(document).ready(function() {
 
    $(document).ready(function() {
  
      setTimeout(function(){
        $('body').addClass('loaded');
        $('h1').css('color','white');
      }, 1000);
      
    });
 
});
</script>   
<script src="/js/core.js" charset="utf-8" async defer></script>
<script src="/js/lightbox.min.js" type="text/javascript" charset="utf-8" async defer></script>
<script src="https://kit.fontawesome.com/c8135e3f4b.js" crossorigin="anonymous"></script>
<?php
    $payment = 'cart';
    if(preg_match("/{$payment}/i", $_SERVER['REQUEST_URI'])): 
?>
    <script src="https://js.paystack.co/v1/inline.js"></script>
    <script>
        // function makePayment()
        // {
        //     $('#paymentForm').submit(function(event) {
        //     var formData = $('#paymentForm').serialize()
        // }
        function payWithPaystack(){
            var handler = PaystackPop.setup({
                key: 'pk_test_97e928422a94753926e88f93cbc9418a94143301',
                email: '<?=$_SESSION['email'];?>',
                amount: <?= $sum; ?> * 100,
                currency: "NGN",
                ref: '<?=mt_rand()?>',
                callback: function(response){
                    $.ajax({
                		type: 'POST',
                		url: '/verify-payment',
                		data: {
                            ref: response.reference
                        },
                		cache: false,
                        async: true,
                        success: function(data) {
                            alert(data.message)
                            window.open('/complete-order/' + response.reference, '_self');
                        },
                        error: function(error){
                            alert(error.message)
                        }
                    })
                    
                },
                onClose: function(){
                    alert('window closed');
                }
            });
            handler.openIframe();
        }
    </script>
<?php endif; ?>
<?php if(preg_match("/{$admin}/i", $_SERVER['REQUEST_URI'])): ?>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        $('#data-table').DataTable();
        $('.dataTables_length').addClass('bs-select');
        $('.dataTables_filter').addClass('bs-select');
    } );
    </script>
<?php endif; ?>
</html>