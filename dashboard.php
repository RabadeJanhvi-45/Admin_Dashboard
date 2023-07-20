<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <!-- Bootstrap links -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>


    <!-- Modal -->
    <div class="modal fade" id="NewUser" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add User</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="form-group">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="mobile" class="form-label">Mobile</label>
                        <input type="number" class="form-control" id="mobile" placeholder="Enter your mobile number">
                    </div>
                    <div class="form-group">
                        <label for="place" class="form-label">Place</label>
                        <input type="text" class="form-control" id="place" placeholder="Enter your mobile number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick="adduser()">Submit</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>

                </div>
            </div>
        </div>
    </div>



    <!-- update modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Update Details</h1>
                    </h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                    <div class="form-group">
                        <label for="upname" class="form-label">Name</label>
                        <input type="text" class="form-control" id="upname" >
                    </div>
                    <div class="form-group">
                        <label for="upemail" class="form-label">Email</label>
                        <input type="email" class="form-control" id="upemail" placeholder="Enter your email">
                    </div>
                    <div class="form-group">
                        <label for="upmobile" class="form-label">Mobile</label>
                        <input type="text" class="form-control" id="upmobile" >
                    </div>
                    <div class="form-group">
                        <label for="upplace" class="form-label">Place</label>
                        <input type="text" class="form-control" id="upplace" placeholder="Enter your mobile number">
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-dark" onclick=updateDetails()>Update</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    <input type="hidden" id="hiddenData">
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <h1 class="text-center"> Admin Panel</h1>
        <!-- Button trigger modal -->
        <button type="button" class="btn btn-dark" data-bs-toggle="modal" data-bs-target="#NewUser">
            Add New User
        </button>
        
    

    </div>
     <div class="container my-3">
           <div id="displayDataTable"></div>
     </div>



    <!-- Bootstrap Javascript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
    $(document).ready(function() {
        displayData();
    });
    //display data
    function displayData() {
        var displayData = "true";
        $.ajax({
            url: "display.php",
            type: 'post',
            data: {
                displaySend: displayData,
            },
            success: function(data, status) {
                $('#displayDataTable').html(data);
            }
        })
    }


    function adduser() {
        var nameAdd = $('#name').val();
        var emailAdd = $('#email').val();
        var mobileAdd = $('#mobile').val();
        var placeAdd = $('#place').val();

        $.ajax({
            url: "insert.php",
            type: 'post',
            data: {
                nameSend: nameAdd,
                emailSend: emailAdd,
                mobileSend: mobileAdd,
                placeSend: placeAdd,
            },
            success: function(data, status) {
                //function to display data
                // console.log(status);
                $('#NewUser').modal('hide');
                displayData();
            }
        });
    }
    //delete record

    function deleteUser(deleteid) {
        $.ajax({
            url: "delete.php",
            type: 'post',
            data: {
                deleteSend: deleteid
            },
            success: function(data, status) {
                displayData()
            }
        });

    }

    //update record
    function updateUser(updateid) {
        $('#hiddenData').val(updateid);
        $.post("update.php", {
            updateid: updateid
        }, function(data, status) {
            var userid = JSON.parse(data);
            $('#upname').val(userid.name);
            $('#upemail').val(userid.email);
            $('#upmobile').val(userid.mobile);
            $('#upplace').val(userid.place);
        });

        $('#updateModal').modal("show");
    }

    //onclick update event
function updateDetails(){
    var upname=$('#upname').val();
    var upemail=$('#upemail').val();
    var upmobile=$('#upmobile').val();
    var upplace=$('#upplace').val();

    var hiddenData=$('#hiddenData').val();

    $.post("update.php",{
        upname:upname,
        upemail:upemail,
        upmobile:upmobile,
        upplace:upplace,
        hiddenData:hiddenData
    },function(data,status){
        $('#updateModal').modal("hide"); 
        displayData();
        
    })
  
    
}
    </script>
</body>

</html>