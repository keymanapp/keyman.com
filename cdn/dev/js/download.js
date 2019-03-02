var loadedCount2 = 50;

function loaded2(){
  
  if(typeof($) == 'undefined') {
    if(--loadedCount2 <= 0) return;
    window.setTimeout(loaded2, 100);
    return;
  }
  if(typeof(bowser) == 'undefined') {
    if(--loadedCount2 <= 0) return;
    window.setTimeout(loaded2, 100);
    return;
  }
  
  if (navigator.userAgent.indexOf("Windows NT 6.0") > -1) {
    // Vista
    $('#vista').addClass('show');
  }
  if (navigator.userAgent.indexOf("Windows NT 5.1") > -1) {
    // XP
    $('#xp').addClass('show');
  }
  
  // redirect if ios or android device
  if ($('body').data('device') == 'iPhone' || $('body').data('device') == 'iPad') {
    window.location.href = '/iphone-and-ipad';
  }
  if ($('body').data('device') == 'Android') {
    window.location.href = '/android';
  }
}
loaded2();
