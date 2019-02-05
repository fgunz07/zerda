@section('custom_js')
<script type="text/javascript">
    $(document).ready(function(){

        //declared variables
        
        var Education = new Object();
        var Locate = new Object();
        var Skill = new Object();
        var Achievement = new Object();

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

        //achievement
        $("a.editInlineAchievement").css("display","none");
        
        $('#achievement').on('mouseover mouseout',function(){
            // alert('hovered');
            $('.editInlineAchievement').toggle();
        });

        //SHOW DETAILS IN PROFILE

        //show education,location and skills so that it will not reload the page when there's changes
        function showData(){
            $.ajax({
                url: `/profile-data`,
                method: 'GET',
                success:function(data){
                    // console.log(data);

                    //Show Education
                    data.education.forEach(item => {
                    //  console.log(item)
                        $('#tertiary').text(item.tertiary);
                        $('#secondary').text(item.secondary);
                        $('#primary').text(item.primary);
                    })

                    //Show Location
                    data.locations.forEach(item => {
                    //  console.log(item);
                        $('#location-ni').text(item.street +','+ item.brgy +','+ item.city +','+ item.province +','+ item.country);
                    })

                    //Show Skill
                    var itemsSkill = [];
                    var changeSkill = [];
                    $.each( data.skills, function(i, item) {
                        // console.log(item);

                    itemsSkill.push('<li>' + item.sklill_desc.description + '</li>');
                    changeSkill.push('<tr><td><input type="hidden" value="'+ item.id +'" class="skillID"><strong><li>'+ item.sklill_desc.description +'</li></strong></td><td><button class="btn btn-danger btn-sm delSkillButton"><i class="glyphicon glyphicon-remove"></i></button></td></tr>');

                    }); // close each()

                    $('#skill').append(itemsSkill.join(''));
                    $('#skillList').append(changeSkill.join(''));

                    //Show Achievement
                    var itemAchievement = [];
                    var changeAchievement = [];
                    $.each( data.achievement, function(i, item) {
                        // console.log(item);

                        itemAchievement.push('<div>' + item.name +'</div>');
                        changeAchievement.push('<tr><td><input type="hidden" value="'+ item.id +'" class="achievementID"><strong><li>'+ item.name +'</li></strong></td><td><button class="btn btn-danger btn-sm delAchieveButton"><i class="glyphicon glyphicon-remove"></i></button></td></tr>');

                    }); // close each()

                    $('#achievementList').append(itemAchievement.join(''));
                    $('#achievementChange').append(changeAchievement.join(''));
        
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

         //click delete skill

        $('body').on('click','delSkillButton',function(){
            var id = $('#SkillTable tbody tr.selected').find('input.skillID').val();
            alert('click');
            console.log(id);
            deleteSkill(id);
            showData();
        });

        //delete Skill
        function deleteSkill(id){

            var id = $('.skillID').val();
            $.ajax({
            url: `/profile-skill-delete/${id}`,
            method: 'POST',
            data: {_token: '{{ csrf_token() }}'},
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

        //click save achievemet
        $('#achievement-save').on('click',function(){
            // alert('click');
            save_achievement();
            showData();
        });

        //store achievement
        function save_achievement(){

    
            Achievement.name = $('[name="name"]').val();
            Achievement.description = $('[name="description"]').val();
            Achievement.year_start = $('[name="year_start"]').val();
            Achievement.year_end = $('[name="year_end"]').val();
          
            $.ajax({
            url: `/profile-achievement`,
            method: 'POST',
            data: {
                name: Achievement.name,
                description: Achievement.description,
                year_start: Achievement.year_start,
                year_end: Achievement.year_end,
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

        //click save profile
        $('#save-profile').on('click',function(){
            // alert('click');
            upload_profile();
            showData();
        });

        //upload profile
        function upload_profile(){

            var form_data = new FormData();
            form_data.append('file', img.files[0]);
            form_data.append('_token', '{{csrf_token()}}');
            $.ajax({
                url: "{{url('profile-upload-pic')}}",
                data: form_data,
                type: 'POST',
                contentType: false,
                processData: false,
                success: function (data) {
                    console.log('data'+ data);
                },
                error: function (error) {
                    
                }
            });
        }

    });//end of document ready
</script>
@stop