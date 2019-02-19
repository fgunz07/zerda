@section('custom_js')
<script type="text/javascript" src="{{ asset('js/star-rating.min.js') }}"></script>
<script type="text/javascript">
    $(document).ready(function(){


        //variables
        var Rate = new Object;

        //rate user
        
        $(document).ready(function(){
            var starrating = new StarRating('#dev-rate');
        });

        $(document).ready(function(){
            var starRatingControls = new StarRating( '.star-rating' );
            // starRatingControls.rebuild();
            // starRatingControls.destroy();
        });

        //save rating
        
        $('#dev-rate').on('change', function() {
            
            var id = $('#devID').val();
            console.log(id);

            Rate.rating = $('[name="rating"]').val();

                    // alert('click');
                    $.ajax({
                        type: 'POST',
                        url: `/user-rate/${id}`,
                        data: {
                            rating: Rate.rating,
                            _token: '{{ csrf_token() }}'
                        },
                            success: function(data){ 
                                swal('Done!','Rate successfully saved.', 'success')
                                starRatingControls.rebuild();
                            }, 
                            error: function(err){
                                swal({
                                title: "Oops!",
                                text: `sorry for this will fixed this soon.`,
                                icon: "error",
                                });
                            }       
                    });
        });

        //Search Developers

        $(document).ready(function() {
            $('#devlist').DataTable();
        } );

        //FILTER DISPLAY BASED ON VALUE OF SELECT BOX

        // $(document).ready(function($) {
        //     $('table').hide();
            
        //     $('#mySelector').change( function(){
        //     var selection = $(this).val();
        //     $('table')[selection? 'show' : 'hide']();
            
        //     if (selection) {
        //         $.each($('#myTable tbody tr'), function(index, item) {
        //         $(item)[$(item).is(':contains('+ selection  +')')? 'show' : 'hide']();
        //         });
        //     }
                
        //     });
        // });

        //TOGGLE ACCORDION ON SELECTED ROW
        $('tr.devs').click(function(){
            $(this).nextUntil('tr.devs').css('display', function(i,v){
                return this.style.display === 'table-row' ? 'none' : 'table-row';
            });
        });

    });//end of document ready
</script>
@stop