<script type="text/javascript">
  window._nsl.push(function ($) {
      $(document).ready(function () {
          var $main = $('#nsl-custom-login-form-main');

          $main.find('.nsl-container')
              .addClass('nsl-container-login-layout-below')
              .css('display', 'block');


          var $jetpackSSO = $('#jetpack-sso-wrap__action');
          if ($jetpackSSO.length) {
              $jetpackSSO
                  .append($main.clone().attr('id', 'nsl-custom-login-form-jetpack-sso'));

              $main.insertBefore('#jetpack-sso-wrap');
          } else {
              var $form = $('#loginform,#registerform,#front-login-form,#setupform');

              if ($form.parent().hasClass('tml')) {
                  $form = $form.parent();
              }

              $main.appendTo($form);
          }
      });
  });
</script>
<style type="text/css">
    #nsl-custom-login-form-main .nsl-container {
        display: none;
    }

    #nsl-custom-login-form-main .nsl-container-login-layout-below {
        clear: both;
        padding: 20px 0 0;
    }

    .login form {
        padding-bottom: 20px;
    }

    #nsl-custom-login-form-jetpack-sso .nsl-container-login-layout-below {
        clear: both;
        padding: 0 0 20px;
    }
</style>
<noscript>
    <style>
        #nsl-custom-login-form-main .nsl-container {
            display: block;
        }
    </style>
</noscript>