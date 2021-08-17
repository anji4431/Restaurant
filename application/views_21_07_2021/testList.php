<div class="loading">Loading&#8230;</div>
        <div class="right_col" role="main">
          <div class="row">
                              <div class="x_content">
                      <div class="row">
                          <div class="col-sm-12">
                            <div class="card-box table-responsive">
</div>
                    <table class="table table-striped table-bordered" id="menuListTable" style="width:100%">
                      <thead style="white-space: nowrap;">
                        <tr >
                          <th>Sr.No.</th>
                          <th>customer Id</th>
                          <th>Name</th>
                          <th>State</th>
                          <th>City</th>
                          <th>Address</th>
                          <th>Dob</th>
                          <th>Mobile No</th>
                          <th>Email</th>
                        </tr>
                      </thead>
                      <tbody >
                 
                      </tbody>
                    </table>
                  </div>
                  </div>
              </div>
            </div>
          </div>
        </div> 

<script type="text/javascript">
    var table;
  $(document).ready(function() {
    base_url    =$('#base_url').val();
    table       =$('#menuListTable').DataTable({ 
        "processing": false,
        "serverSide": true,
        "order": [],
       //  "language": {
       // "infoFiltered": "",
       //  processing:"<img src=<?php echo base_url();?>assets/images/ajax-loader.gif> Please Wait",
       //  search: "",searchPlaceholder:"Search" 

       //  },
        "ajax": {
            "url": base_url+'Test/getTestList',
            "type": "POST",
            "dataType":"JSON",
            "data": function ( data ) {

            }
        },
 
        "columnDefs": [
        { 
            "targets": [ -1 ],
            "orderable": false, 
        },
        ],

    });

});
</script>