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

        Rate.rating = $('[name="rating"]').val();

                alert('click');
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

    });//end of document ready
</script>
@stop