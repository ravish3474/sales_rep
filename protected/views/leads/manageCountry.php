<style>
    .manageCountryTableMain th,
    .manageCountryTableMain td {
        text-align: center;
    }

    .manageCountryTableMain {
        padding: 20px 0;
    }

    .manageCountryTableMain table {
        width: 30%;
    }

    .manageCountryTableMain .btn {
        padding: 3px 20px;
        font-size: 14px;
        margin: 0;
    }
</style>

<div class="">
    <div class="row">
        <div class="col-md-12 col-sm-12 col-xs-12  ">
            <div class="x_panel">
                <div class="adminLeadsPage">
                    <div class="x_title">
                        <h2>Edit Country</h2>
                        <div class="clearfix"></div>
                    </div>
                    <div class="country_dara">
                        <div class="" id="output_div">

                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
</div>

<!-- Edit country modal  -->

<div class="modal fade smallModal" id="editDetailsModal" role="dialog">
    <div class="modal-dialog  ">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Edit Details</h4>
            </div>


            <form class="editform" method="post" action="updateCountryName">
                <div class="modal-body">
                    <div class="form-group">
                        <label for="action_ype" class="blackLabel">Country Name</label>
                        <input type="text" name="country_name" id="country_name" value="">
                    </div>

                    <input type="hidden" name="cou_id" id="cou_id" value="">
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn greenBtn ">Save</button>
                </div>
            </form>
        </div>

    </div>
</div>




<script>
    function getCountryData() {
        showLoader();

        $.ajax({
            url: 'getCountryData',
            method: 'POST',
            dataType: 'json',
            contentType: 'application/json',
            data: {
                id: ''
            },
            success: function(response) {
                hideLoader();
                console.log(response.html);
                $('#output_div').html(response.html);
            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Can not get the data',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });
                hideLoader();

            }
        });
    }

    $(document).ready(function() {
        getCountryData();
    });

    $(document).on('click', '.editbtn', function() {
        let modal = $('#editDetailsModal');
        let data_country = $(this).data('name');
        let id = $(this).data('val_id');

        $('#country_name').val(data_country);
        $('#cou_id').val(id);
        modal.modal('show');
    });

    $(document).on('submit', '.editform', function(event) {
        event.preventDefault();

        let form = $(this);
        let data = form.serialize();
        let method = form.attr('method');
        let url = form.attr('action');

        $.ajax({
            url: url,
            method: method,
            data: data,
            success: function(response) {
                $('#editDetailsModal').modal('hide');
                form[0].reset();
                getCountryData();

            },
            error: function(xhr, status, error) {
                Swal.fire({
                    title: 'Something went wrong',
                    icon: 'warning',
                    confirmButtonText: 'Got it!'
                });


            }
        });

    })
</script>