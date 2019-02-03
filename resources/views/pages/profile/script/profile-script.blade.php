@section('custom_js')

<script type="text/javascript">
    $(document).ready(function(){

        //declared variables
        
        var Education = new Object();
        var Locate = new Object();
        var Skill = new Object();
        var Note = new Object();

        //Display Profile data auto-refresh
        showData();

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

        //SHOW DETAILS IN PROFILE

        //show education,location and skills so that it will not reload the page when there's changes
        function showData(){
            $.ajax({
                url: `/profile-data`,
                method: 'GET',
                success:function(data){
                    console.log(data);
                    data.education.forEach(item => {
                    //  console.log(item)
                        $('#tertiary').text(item.tertiary);
                        $('#secondary').text(item.secondary);
                        $('#primary').text(item.primary);
                    })

                    data.locations.forEach(item => {
                     console.log(item);
                        $('#location-ni').text(item.street +','+ item.brgy +','+ item.city +','+ item.province +','+ item.country);
                    })


        
                },
                error:function(error){
                }
            });//end of ajax
        }

        //click save eduation
        $('#educ-save').on('click',function(){
            // alert('click');
            save_education();
            showData();
        });

        //store education
        function save_education(){

    
            Education.primary = $('[name="primary"]').val();
            Education.secondary = $('[name="secondary"]').val();
            Education.tertiary = $('[name="tertiary"]').val();


            $.ajax({
            url: `/profile-education`,
            method: 'POST',
            data: {
                primary: Education.primary,
                secondary: Education.secondary,
                tertiary: Education.tertiary,
                _token: '{{ csrf_token() }}'
                },
                success: function(data){
                    swal('Done!','Record successfully saved.', 'success')
                },
                error: function(err){
                    swal({
                    title: "Oops!",
                    text: `sorry for this will fixed this soon.`,
                    icon: "error",
                    });
                }
            });
        }

        //click save location
        $('#location-save').on('click',function(){
            alert('click');
            save_location();
            showData();
        });

        //store location
        function save_location(){

    
            Locate.street = $('[name="street"]').val();
            Locate.brgy = $('[name="brgy"]').val();
            Locate.city = $('[name="city"]').val();
            Locate.province = $('[name="province"]').val();
            Locate.country = $('[name="country"]').val();


            $.ajax({
            url: `/profile-location`,
            method: 'POST',
            data: {
                street: Locate.street,
                brgy: Locate.brgy,
                city: Locate.city,
                province: Locate.province,
                country: Locate.country,
                _token: '{{ csrf_token() }}'
                },
                success: function(data){
                    swal('Done!','Record successfully saved.', 'success')
                },
                error: function(err){
                    swal({
                    title: "Oops!",
                    text: `sorry for this will fixed this soon.`,
                    icon: "error",
                    });
                }
            });
        }

         //click save skill
         $('#skill-save').on('click',function(){
            // alert('click');
            save_skil();
            showData();
        });

        //store skill
        function save_skil(){

    
            Skill.name = $('[name="skill"]').val();
          
            $.ajax({
            url: `/profile-skill`,
            method: 'POST',
            data: {
                name: Skill.name,
                _token: '{{ csrf_token() }}'
                },
                success: function(data){
                    swal('Done!','Record successfully saved.', 'success')
                },
                error: function(err){
                    swal({
                    title: "Oops!",
                    text: `sorry for this will fixed this soon.`,
                    icon: "error",
                    });
                }
            });
        }

        
       
       
    });//end of document ready
</script>
@stop