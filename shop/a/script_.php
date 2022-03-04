<?php global $home; ?>
<script src="<?php echo "$home"; ?>vendor/jquery/jquery.min.js"></script>
<script src="<?php echo "$home"; ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<script src="<?php echo "$home"; ?>vendor/select2/js/select2.min.js"></script>
<script src="<?php echo "$home"; ?>vendor/owl-carousel/owl.carousel.js"></script>
<script src="<?php echo "$home"; ?>js/custom.js"></script>
<script src="<?php echo "$home"; ?>js/rocket-loader.min.js"></script>
<script src="<?php echo "$home"; ?>js/beacon.min.js"></script>
<script src="<?php echo "$home";?>js/toastr.min.js"></script>
<?php
if (isset($_SESSION['error'])){
    warn($_SESSION['error']);
    unset($_SESSION['error']);
}
?>
<script>
cart();
$('.minus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());
    if (value > 1) {
        value = value - 1;
    } else {
        value = 0;
    }
    $input.val(value);
});

$('.plus-btn').on('click', function(e) {
    e.preventDefault();
    var $this = $(this);
    var $input = $this.closest('div').find('input');
    var value = parseInt($input.val());
    if (value < 100) {
        value = value + 1;
    } else {
        value =100;
    }
    $input.val(value);
});
function coupon(){
    var coupon = document.getElementById('coupon').value;
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>coupon',
        data: {coupon:coupon},
        success: function(response) {
            $('.coupon').html(response);
            cart();
        }
    });
    cart();
}
function uncoupon(){
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>AuisdGyuTA780we989e89',
        success: function(response) {
            $('.coupon').html(response);
            cart();
        }
    });
    cart();
}
function cart(){
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>changes',
        success: function(response) {
            $('.makprantos').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>ccpn',
        success: function(response) {
            $('.vmware').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>Kdbhb78sJvsdvg',
        success: function(response) {
            $('#cvbv').html(response);
            $('.cvbv').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>Uhd9h',
        success: function(response) {
            $('#delivery_charges').html(response);
            $('.delivery_charges').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>buntu',
        success: function(response) {
            $('.slimon').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>buntus',
        success: function(response) {
            $('.slimons').html(response);
        }
    });
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>dsb',
        success: function(response) {
            $('.cart-amount').html(response);
        }
    });
}
function add_to_basket(product, quantity,) {
    var quant = document.getElementById(quantity).value;
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>J9sb38Dl0IwxJs3jSjopQ20X',
        data: {
            product: product,
            quantity: quantity,
            quant: quant
        },
        success: function(response) {
            $('.makpranto').html(response);
        }
    });
    cart();
}
function un__cart(item) {
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>X02QpojSj3sJxwI0lD83bs9J',
        data: {item:item},
        success: function(response) {
            $('.makpranto').html(response);
        }
    });
    cart();
}
function edit_basket(product, quantity) {
    var quant = document.getElementById(quantity).value;
    $.ajax({
        type: 'POST',
        url: '<?php echo "$home"; ?>change',
        data: {
            product: product,
            quant: quant
        },
        success: function(response) {
            $('.makpranto').html(response);
        }
    });
    cart();
}

$('.product_finder').typeahead({
    source: function(query, result) {
        $.ajax({
            items: 20,
            url: "<?php echo  $home; ?>sUebY8uebsdb",
            data: 'query=' + query,
            dataType: "json",
            autoSelect: false,
            type: "POST",
            success: function(data) {
                result($.map(data, function(item) {
                    return item;
                }));
            },
        });
    },
    'updater': function(item) {
        this.$element[0].value = item;
        this.$element[0].form.submit();
        return item;
    }
});
</script>
