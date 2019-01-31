@section('custom_js')

<script type="text/javascript">
    $(document).ready(function(){

        //profile
        $("a.editInline").css("display","none");

        $('#profile').on('mouseover mouseout',function(){
            $('.editInline').toggle();
        });

        //education
        $("a.editInlineEdu").css("display","none");
        
        $('#education').on('mouseover mouseout',function(){
            // alert('hovered');
            $('.editInlineEdu').toggle();
        });

         //location
         $("a.editInlineLocation").css("display","none");
        
        $('#location').on('mouseover mouseout',function(){
            // alert('hovered');
            $('.editInlineLocation').toggle();
        });

        //skills
        $("a.editInlineSkills").css("display","none");
        
        $('#skills').on('mouseover mouseout',function(){
            // alert('hovered');
            $('.editInlineSkills').toggle();
        });

         //notes
         $("a.editInlineNotes").css("display","none");
        
        $('#notes').on('mouseover mouseout',function(){
            // alert('hovered');
            $('.editInlineNotes').toggle();
        });
       
       
    });//end of document ready
</script>
@stop