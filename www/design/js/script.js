$(document).ready(function () {

        $('.first-button').on('click', function () {

          $('.animated-icon1').toggleClass('open');
        });
        $('.second-button').on('click', function () {

          $('.animated-icon2').toggleClass('open');
        });
        $('.third-button').on('click', function () {

          $('.animated-icon3').toggleClass('open');
        });
        $('.homepage-gallery-carousel').owlCarousel({
            stagePadding: 50,
            loop:true,
            margin:20,
            nav:false,
            dots: false,
            autoplay:1000,
            responsive:{
                0:{
                    items:1
                },
                600:{
                    items:3
                },
                1000:{
                    items:7
                }
            }
        })

        $('.material-carousel').owlCarousel({
            loop:false,
            margin:20,
            nav:false,
            dots: false,
            responsive:{
                0:{
                    items:1,
                    stagePadding: 10,
                    margin:5
                },
                650:{
                   items:2,
                   stagePadding: 50
                },
                1000:{
                    items:3
                },
                1400:{
                    items:4
                }
            }
        })

        $(".hp-new-head a").click(function(e){
          e.preventDefault();
          let data_id = $(this).attr("data-id");
          $(".hp-new-head a").removeClass("active");
          $(this).addClass("active");
          $(".hp-content").css("display", "none");
          $(".hp-content#"+data_id).css("display", "flex");
        });


        $(".select-box").change(function(event){
          event.preventDefault();
          let data_id = $(this).val();
          $(".dotace-content").css("display","none");
          $("#"+data_id).css("display", "block");
        });

        $(".dotace-heading a").click(function(e){
          e.preventDefault();
          $(".dotace-heading a").removeClass("active");
          $(this).addClass("active");
          let data_id = $(this).attr("data-id");
          $(".dotace-content").css("display","none");
          $("#"+data_id).css("display", "block");
        });
        $(".routine-heading_item").click(function(e){
          e.preventDefault();
          $(".routine-heading_item").removeClass("active");
          $(this).addClass("active");
          let data_id = $(this).attr("data-id");
          $(".routine-content").css("display","none");
          $("#"+data_id).css("display", "block");
          $("#r"+data_id).css("display", "block");

        })

        $(".sipka-up").click(function(){
          $('html, body').animate({
              scrollTop: $("body").offset().top
          }, 1000);
        })

        $("#kontakt-form").submit(function(e) {

      e.preventDefault(); // avoid to execute the actual submit of the form.

      var form = $(this);
      var url = form.attr('action');

      $.ajax({
             type: "POST",
             url: url,
             data: form.serialize(), // serializes the form's elements.
             success: function(data)
             {
               let obj = JSON.parse(data);
               $(".alert").css("display","none");
               $(".alert-success").css("display", "block");
               $(".success-message").html(obj.message);
               $(".form-button").html("<img src='icons/fajfka.svg'> <span>Odesláno</span>");
             },
             error: function (data) {
              let obj = JSON.parse(data.responseText);
              $(".alert").css("display","none");
              $(".alert-danger").css("display", "block");
              $(".error-message").html(obj.message);
            }
           });


      });

      });


