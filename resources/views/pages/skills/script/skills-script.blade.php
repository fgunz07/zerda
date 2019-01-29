@section('custom_js')

<script type="text/javascript">
    $(document).ready(function(){

        //Select row

        $('#skill-list tbody').on('click', 'tr',function(event){
       
        $('#skill-list tbody tr').removeClass('selected')
        $(this).addClass('selected')

        // console.log('selected');

        });

        //delete category

        $('body').on('click','.delete-skill',function(){
            // alert('click');
            deleteSkill();
        });

        function deleteSkill(id){

           var id = $('body').find('#skill-list tbody tr.selected .skillID').val();
           console.log(id);

           $.ajax({
                url: `/skills-delete/${id}`,
                method: 'DELETE',
                data: { _token: '{{ csrf_token()}}' },
                success: function(data){
                    swal(
                        'Deleted!',
                        'Your file has been deleted.',
                        'success' 
                    ).then(()=>{
                        location.reload();
                    });

                    // swal({
                    //   title: "Are you sure?",
                    //   text: "Once deleted, you will not be able to recover this imaginary file!",
                    //   icon: "warning",
                    //   buttons: true,
                    //   dangerMode: true,
                    // })
                    // // .then((willDelete) => {
                    //   // if (willDelete) {
                    //   //   swal("Your imaginary file has been deleted!", {
                    //   //     icon: "success",
                    //   //   });
                    //   //   location.reload();
                    //   // } else  {
                    //   //   swal("Your imaginary file is safe!");
                    //   // }
                    // // });
                    // .then(function(result) {
                    //   // handle confirm, result is needed for modals with input
                    //   if (willDelete) {
                    //     swal("Your imaginary file has been deleted!", {
                    //       icon: "success",
                    //     });
                    //     location.reload();
                    //   } 
                    // }, function(dismiss) {
                    //   // dismiss can be "cancel" | "close" | "outside"
                    //   if (dismiss == 'cancel')  {
                    //     swal("Your imaginary file is safe!");
                    //   }
                    // });

                    },
                    error: function(err){
                        swal('Error!','Please report this issue.', 'error');
                    }
            });

        }


       
    });//end of document ready
</script>
@stop