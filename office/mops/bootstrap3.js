function mop(){
    $.ajax({
    type: 'POST',
    url: 'add.php',
    data: $('#frmBox').serialize(),
    success:function(response){
        $('#oil').html(response);
        // $('#myModal2').modal('toggle');
    }
});
return false;
}
$('.dataTables-example').DataTable({
    pageLength: 10,
    responsive: true,
    dom: '<"html5buttons"B>lTfgitp',
    buttons: [
        { extend: 'copy'},
        {extend: 'csv', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
        {extend: 'excel', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
        {extend: 'pdf', title: '<?php echo "$company_name All Methods of Payment as at ". date("d F, Y"); ?>'},
        {extend: 'print',
         customize: function (win){
            $(win.document.body).addClass('white-bg');
            $(win.document.body).css('font-size', '10px');
            $(win.document.body).find('table')
                    .addClass('compact')
                    .css('font-size', 'inherit');
        }
        }
    ]

});
$(document).on('click', 'a[data-role=update]', function(){
    var id = $(this).data('id');
    var name = $('#'+id).children('td[data-target=name]').text();
    var rate = $('#'+id).children('td[data-target=rate]').text();
    var status = $('#'+id).children('td[data-target=status]').text();
    $('#name').val(name);
    $('#rate').val(rate);
    $('#status').val(status);
    $('#user-id').val(id);
    $('#myModal').modal('toggle');
});
$('#save').click(function(){
    var id = $('#user-id').val();
    var name = $('#name').val();
    var rate = $('#rate').val();
    var status = $('#status').val();
    $.ajax({
        url: 'save.php',
        method: 'post',
        data: { id : id, name : name, rate : rate, status : status},
        success: function(response){
            $('#oil').html(response);
            // $('#myModal').modal('toggle');
        }
    });
})
