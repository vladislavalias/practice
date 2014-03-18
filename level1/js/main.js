$(document).ready(function(){
    $('.ava_pic').on('mouseover', function(abc){
      
      $('.choose_pic').slideDown('fast');
    });

    $('.ava_pic').on('mouseout', function(){
      $('.choose_pic').slideUp('fast');
    });
    
    $('#country_select').on('change', function(){
      var citySelectName = 'city_' + $(this).val();
      
      $('select[id^=city_]').css('display', 'none');
//      $('#city').css('display', 'table-row');
      $('#city').fadeIn('fast');
      $('#city').find('div.hidden').fadeIn('fast');
      $('#' + citySelectName).css('display', 'inline-block');
    });
    
    $('.show_adress_select').on('change', function(){
      $('#street').fadeIn();
      $('#street').find('div.hidden').fadeIn();
      $('#house').fadeIn();
      $('#house').find('div.hidden').fadeIn();
    });
    
    $('#registration-form').submit(function(){
      var result = true;
      $('.error').css('display', 'none');
      
      result = validateOnEmpty('#registration-name', 'INPUT NAME, BEACH!') && result;
      result = validateOnEmpty('#registration-password', 'INPUT PASSWORD, BEACH!') && result;
      result = validateOnEmpty('#registration-password2', 'REPEAT PASSWORD, BEACH!') && result;
      result = validateOnEmpty('#registration-email', 'input data, please!') && result;
      result = validateOnEmpty('#country_select', 'input data, please!') && result;
      result = validateOnEmpty('#city_' + $('#country_select').val(), 'input data, please!') && result;
      result = validateOnEmpty('#street_name', 'Are you BOMJ?') && result;
      result = validateOnEmpty('#number_house', 'You really BOMJ?') && result;
      result = validateOnEmpty('.choose_sex', 'Are you trans?', ':checked') && result;
      result = validateOnEmpty('.give_agree', 'It`s your protest?', ':checked') && result;
      result = validateIsEqual('#registration-password', '#registration-password2', 'Write a correct pass!') && result;
      
      return result;
    });
    
    $('.close_error').on('click', function(){
      $(this).parents('.error').css('display', 'none');
    });
  }
);
  
function validateOnEmpty(elementName, errorMessage, selector)
{
  selector = selector || '';
  
  if ("" == $(elementName + selector).val() || undefined == $(elementName + selector).val())
  {
    return showError(elementName, errorMessage);
  }
  else
  {
    return true;
  }
  return ("" == $(elementName).val() ? showError(elementName, errorMessage) : true); 
}

function validateIsEqual(firstElement, secondElement, errorMessage)
{
  if ($(firstElement).val() != $(secondElement).val())
  {
    return showError(secondElement, errorMessage);
  }
  else
  {
    return true;
  }
}

function showError(elementName, message)
{
  var errorContainer = $(elementName).nextAll('.error');
  errorContainer.css('display', 'block');
  errorContainer.children('.error-message').html(message);
  selector = 234234;
  
  return false;
}