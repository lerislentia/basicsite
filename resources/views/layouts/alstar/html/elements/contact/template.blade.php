<!-- Contact -->
<section id="contact" class="home-section bg-gray">
    <div class="container">
      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div class="section-heading">
            <h2>{{ __('contact.contactus') }}</h2>
            <div class="heading-line"></div>
            <p>{{ __('contact.intro') }}. </p>
          </div>
        </div>
      </div>

      <div class="row">
        <div class="col-md-offset-2 col-md-8">
          <div id="sendmessage" style="display:none">{{ __('contact.sended') }}. {{ __('contact.thankyou') }}!</div>
          <div id="errormessage" style="display:none">>tu mensaje no pudo ser enviado por favor intenta mas tarde</div>

          <form id="ContactForm" action="{{ $action or ''}}" method="post" class="form-horizontal contactForm" role="form">
          {{ csrf_field() }}
            <div class="col-md-offset-2 col-md-8">
              <div class="form-group">
                <input type="text" name="name" class="form-control" id="name" placeholder="{{ __('contact.YourName') }}" data-rule="minlen:4"
                  data-msg="Please enter at least 4 chars" required/>
                <div class="validation"></div>
              </div>
            </div>

            <div class="col-md-offset-2 col-md-8">
              <div class="form-group">
                <input type="email" class="form-control" name="email" id="email" placeholder="{{ __('contact.YourEmail') }}" data-rule="email"
                  data-msg="Please enter a valid email" required/>
                <div class="validation"></div>
              </div>
            </div>

            <div class="col-md-offset-2 col-md-8">
              <div class="form-group">
                <input type="text" class="form-control" name="subject" id="subject" placeholder="{{ __('contact.Subject') }}" data-rule="minlen:4"
                  data-msg="Please enter at least 8 chars of subject" required/>
                <div class="validation"></div>
              </div>
            </div>

            <div class="col-md-offset-2 col-md-8">
              <div class="form-group">
                <textarea class="form-control" name="message" id="message" rows="5" data-rule="required" data-msg="{{ __('contact.Pleasewrite') }}"
                  placeholder="{{ __('contact.Message') }}" required></textarea>
                <div class="validation"></div>
              </div>
            </div>
            <div class="form-group">
              <div class="col-md-offset-2 col-md-8">
                <button type="button" id="IdSaveMessage" class="btn btn-theme btn-lg btn-block">{{ __('contact.sendmessage') }}</button>
              </div>
            </div>

            <input type="hidden" name="locale" value="{{ session('locale') }}">

          </form>

        </div>
      </div>

    </div>
  </section>


<script type="text/javascript">

$(document).ready(function () {

  $("#IdSaveMessage").click(function(){

    var data = $('#ContactForm').serialize();

    $.ajax({
          url: "{{ route('contact.messages.send') }}",
          type: "POST",
          data: data,
          async: false,
          success: function () {
             $("#errormessage").hide();
             $("#sendmessage").show().delay(3000).fadeOut();
             $("#name").val('');
             $("#email").val('');
             $("#subject").val('');
             $("#message").val('');
          },
          error: function () {
              console.log("[ERROR] Method: sendmessage");
              $("#errormessage").show().delay(3000).fadeOut();
              $("#sendmessage").hide(); 
          }
      });
  }); 

});

</script>
