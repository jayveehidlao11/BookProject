$(document).ready(function(){
    $('#book-modal').on('hidden.bs.modal', function () {
        $("#form")[0].reset();
    });
    $("form").on('submit',function(e){
        e.preventDefault();
        let form_data = new FormData(this);
        
        $.ajax({
            url:"controllers/Bookcontroller.php",
            type:"POST",
            data:form_data,
            dataType: 'json',
            processData: false, 
            contentType: false, 
            success:function(data){
                Swal.fire({
                    title: data.message,
                    icon: data.status,
                    draggable: true
                  });
                getDatatable();
            }
        });
    });
    getDatatable();
    $(document).on('click', 'button', function() {
    // $('button').on('click',function(){
        let tag = $(this).attr('tag');
      
        if(typeof tag != 'undefined'){
            const id = $(this).data('id');
            switch (tag) {
                case 'delete':
                    deleteBooks(id);
                    break;
                case 'edit':
                    edit(id);
                    break;
                default:
                    break;
            }
            $("[name=book_id]").val(id);
            $("#form").find('[name=action]').val(tag);
            
        }
    });
});

function deleteBooks(id){
    let form_data = new FormData();
    form_data.append('id', id);    
    form_data.append('action', 'delete');
    $.ajax({
        url:"controllers/Bookcontroller.php",
        type:"POST",
        data:form_data,
        dataType: 'json',
        processData: false, 
        contentType: false, 
        success:function(data){
            Swal.fire({
                title: data.message,
                icon: data.status,
                draggable: true
              });
            getDatatable();
        }
    });
}
function edit(id){
    let form_data = new FormData();
    form_data.append('id', id);    
    form_data.append('action', 'edit');
    $.ajax({
        url:"controllers/Bookcontroller.php",
        type:"POST",
        data:form_data,
        dataType: 'json',
        processData: false, 
        contentType: false, 
        success:function(data){
           $("[name=title]").val(data.Title);
           $("[name=isbn]").val(data.isbn);
           $("[name=author]").val(data.Author);
           $("[name=publisher]").val(data.Publisher);
           $("[name=yearpublished]").val(data.YearPublished);
           $("[name=category]").val(data.Category);
           $("#book-modal").modal('show');
           $("#form").find('[name=action]').val('editsaved');
        }
    });
}
function getDatatable() {
    $('.bookDatatable tbody').html('');
    $.ajax({
        url: "controllers/Datatable.php",
        type: "GET",
        dataType: 'json',
        success: function(data) {
            let html = '';
            if(data.length == 0){
                html = `
                    <tr><td colspan=7>No data</td></tr>
                `;
            }else{
                data.forEach((book, index) => {
                    html += `
                        <tr>
                            <td>${book.Title || ''}</td>
                            <td>${book.isbn || ''}</td>
                            <td>${book.Author || ''}</td>
                            <td>${book.Publisher || ''}</td>
                            <td>${book.YearPublished || ''}</td>
                            <td>${book.Category || ''}</td>
                            <td>
                                <button class="btn-edit" tag="edit" data-id="${book.ID}">Edit</button>
                                <button class="btn-delete" tag="delete" data-id="${book.ID}">Delete</button>
                            </td>
                        </tr>
                    `;
                });
            }
           
            $('.bookDatatable tbody').html(html);
        }
    });
}