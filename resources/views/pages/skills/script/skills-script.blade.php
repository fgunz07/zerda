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

                    },
                    error: function(err){
                        swal('Error!','Please report this issue.', 'error');
                    }
            });

        }


       
    });//end of document ready
</script>
@stop