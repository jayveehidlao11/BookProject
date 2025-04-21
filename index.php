<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book</title>
    <link rel="stylesheet" href="css/style.css">

    
    <!-- BOOTSTRAP CDN -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <!-- END OF BOOTSTRAP CDN -->

    <!-- GOOGLE FONT -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Bebas+Neue&family=Roboto+Mono:ital,wght@0,100..700;1,100..700&display=swap" rel="stylesheet">
    <!-- END OF GOOGLE FONT -->

    <!-- JQUERY -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

</head>
<body>
    <?php
        @include('database/db.php');
    ?>
    <!-- modal -->
        <div class="modal fade" id="book-modal" tabindex="-1" role="dialog" aria-labelledby="book-modal" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLongTitle">BOOK INFORMATION</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="#" method="post" id="form" autocomplete="off">
            <input type="hidden" name="action">
            <input type="hidden" name="book_id">
            <div class="row">
                <div class="form-group">
                    <input type="text" name="title" id="title" placeholder="Input title" required>
                </div>
                <div class="form-group">
                    <input type="text" name="isbn" id="isbn" placeholder="Input ISBN" required>
                </div>
                <div class="form-group">
                    <input type="text" name="author" id="author" placeholder="Input Author" required>
                </div>
                <div class="form-group">
                    <input type="text" name="publisher" id="publisher" placeholder="Input publisher" required>
                </div>
                <div class="form-group">
                    <input type="number" name="yearpublished" id="yearpublished" placeholder="Input year published" required>
                </div>
                <div class="form-group">
                    <input type="text" name="category" id="category" placeholder="Input category" required>
                </div>
                <div class="form-group">
                    <button type="submut"> SAVE </button>
                </div>
            </div>
        </form>
      </div>
    </div>
  </div>
</div>
<!-- end of modal -->
    <div class="container">
        <div class="row-1">
            <button type="button"  data-toggle="modal" data-target="#book-modal" tag="add">
                Add
            </button>
        </div>
        <div class="row-2">
            <div class="table-responsive">
                <table class="bookDatatable">
                    <thead>
                        <tr>
                            <th>TITLE</th>
                            <th>ISBN</th>
                            <th>AUTHOR</th>
                            <th>PUBLISHER</th>
                            <th>YEAR PUBLISHED</th>
                            <th>CATEGORY</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS + Popper -->
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="js/main.js"></script>
</body>
</html>