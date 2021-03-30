---
title: Keyman 14 Launch Webinar Series
---

[< Back to Keyman 14.0 Home](/14)

We will be holding a series of webinars all about Keyman 14 running between 29
March and 1 April 2021.

A link will be published here for access to the webinars shortly before they go
live. All webinars will be recorded and the recordings will be added here when
they are available.

We will also announce the webinars on [Twitter](https://twitter.com/keyman) and
[Facebook](https://facebook.com/keymanapp) before they go live.

We will have some time for questions in each webinar. The 'Welcome to Keyman 14'
webinar will have an overview of the major new features in Keyman 14, and then
we'll go into a more detailed walk through the changes in each product in the
individual product webinars.

<p style='display: none' id='webinar-cta'>
<a href='https://sil.zoom.us/j/97219405404?pwd=SDY5VDdKRjA3UEtxd2xjeUdUR20wZz09'
class="generic-cta-button" target='_blank'>Join the webinar now!</a></p>

<style>
  @import '/cdn/dev/css/product-grid.css';
</style>
<table class='product-grid'>
<thead>
  <tr>
    <th>Webinar topic</th>
    <th>Length<br>(mins)</th>
    <th>Your local time</th>
    <th>Time (UTC)</th>
    <th>Links</th>
  </tr>
</thead>
<tbody id='webinar-tbody'></tbody>
</table>

<script>
  var webinars = [
    ['MD', 'Welcome to Keyman 14',  45, 2, 29, 19, 0, '1uzOmQSA2oemkwD0N8QiUMx-Q8WwfRuw2UWsfdipEGfc', 'OwiZdkjH1Dg'],
    ['MD', 'Welcome to Keyman 14 (repeat)',  45, 2, 30,  8, 0, '1uzOmQSA2oemkwD0N8QiUMx-Q8WwfRuw2UWsfdipEGfc'],

    'Product webinars',
    ['DW', 'Keyman 14 for Android', 30, 2, 30,  9, 0, '14LVaPdBVNVNK-VZSnnf4bY91w4_L4iRBv7F4Z26UdIU'],
    ['MD', 'Keyman 14 for macOS',   30, 2, 30,  9, 30, '1TM2nNYaDpa8IgkRfiSEQe8dCytw5jBi8NAYTzCRJJiQ'],

    ['MD', 'Keyman 14 for Windows', 30, 2, 30, 19, 0, '1iCmRRq_eDBMTIetZNnPg6pPXqsBzpM72cNJV7_Liyd8'],
    ['JH', 'Keyman 14 for iOS',     30, 2, 31,  8, 0, '1w3EfFny_XPHS7BV9VyUwXE3MCx_hsp5NMfB7jzWAbJo'],
    ['JH', 'keymanweb.com and KeymanWeb Bookmarklet', 30, 2, 31, 8, 30, '1W4JPfWqjCGg3S40_peWmYmbqakyir3xCXUKyADCwazY'],
    ['EB', 'Keyman 14 for Linux',   30, 2, 31,  9, 0, '1V4tziNcu_y2ZbUjIqaj-c35PKn2t6ulbXo1Qv0zmgk4'],

    'For keyboard developers',
    ['MD', 'Keyman Developer 14',   45, 3,  1,  8, 0, '1oEZzGPwXKw22fljs8fqjQI6Iie_el9eGskx-HRi7SV8'],
    ['JH', 'Keyman lexical models', 45, 3,  1,  9, 0, '1RiRdLl9uCouAgqO1XLs2a0QjpIFXPYKknh-b3GPo84E']
  ];

  function icalDate(date) {
    return date.toISOString().replace(/[-:.]/g, '').substr(0, 15)+'Z';
  }

  function uuidv4() { // https://stackoverflow.com/a/2117523/1836776
    return ([1e7]+-1e3+-4e3+-8e3+-1e11).replace(/[018]/g, c =>
      (c ^ crypto.getRandomValues(new Uint8Array(1))[0] & 15 >> c / 4).toString(16)
    );
  }

  var tbody = document.getElementById('webinar-tbody');
  for(var i in webinars) {
    var webinar = webinars[i];
    var tr = document.createElement('tr');
    if(typeof webinar == 'string') {
      var td0 = document.createElement('th');
      td0.colSpan = 5;
      td0.innerText = webinar;
      tr.appendChild(td0);
    } else {
      var td0 = document.createElement('td');
      var td1 = document.createElement('td');
      var td2 = document.createElement('td');
      var td3 = document.createElement('td');
      var td4 = document.createElement('td');
      var dt = new Date(Date.UTC(2021, webinar[3], webinar[4], webinar[5], webinar[6]));
      var dtEnd = new Date(dt.valueOf() + parseInt(webinar[2], 10) * 60 * 1000);
      td0.innerText = webinar[1];
      var span = document.createElement('span');
      span.id = 'webinar-cta-'+i;
      span.style.display = 'none';
      span.appendChild(document.createElement('br'));
      a = document.createElement('a');
      a.style.color = 'red';
      a.href="https://sil.zoom.us/j/97219405404?pwd=SDY5VDdKRjA3UEtxd2xjeUdUR20wZz09";
      a.innerText = 'Running now - join here!';
      a.target = "_blank";
      span.appendChild(a);
      td0.appendChild(span);

      td1.innerText = webinar[2];
      var span0 = document.createElement('span');
      span0.innerText = dt.toLocaleString([], {
          weekday: 'short',
          year: 'numeric',
          month: 'short',
          day: 'numeric',
        });
      td2.appendChild(span0);
      td2.appendChild(document.createElement('br'));
      span0 = document.createElement('span');
      span0.innerText = dt.toLocaleString([], {
          timeZoneName: 'short',
          hour: '2-digit',
          minute:'2-digit'
        });
      td2.appendChild(span0);

      span0 = document.createElement('span');
      span0.innerText = dt.toLocaleString([], {
        timeZone: 'UTC',
        weekday: 'short',
        year: 'numeric',
        month: 'short',
        day: 'numeric'
      });
      td3.appendChild(span0);
      td3.appendChild(document.createElement('br'));
      span0 = document.createElement('span');
      span0.innerText = dt.toLocaleString([], {
        timeZone: 'UTC',
        timeZoneName: 'short',
        hour: '2-digit',
        minute:'2-digit'
      });
      td3.appendChild(span0);

      if(dtEnd.valueOf() < Date.now()) {
        // Presentation and video links
        var a0 = document.createElement('a');
        a0.innerHTML = '<img src="slides.svg" style="width:16px; margin: 0 4px; vertical-align: text-bottom" /> View slides';
        a0.href = 'https://docs.google.com/presentation/d/'+webinar[7]+'/edit?usp=sharing';
        a0.style.color = 'blue';
        a0.target = '_blank';
        td4.appendChild(a0);
        if(webinar[8]) {
          // video link
          td4.appendChild(document.createElement('br'));
          a0 = document.createElement('a');
          a0.innerHTML = '<img src="video.png" style="width:16px; margin: 3px 4px 0; vertical-align: top" />  Watch video';
          a0.href = 'https://youtu.be/'+webinar[8];
          a0.style.color = 'blue';
          a0.target = '_blank';
          td4.appendChild(a0);
        }
      } else {
        // Calendar links
        var a0 = document.createElement('a');
        a0.innerHTML = 'Google&nbsp;Calendar';
        a0.href = 'https://www.google.com/calendar/render?action=TEMPLATE'+
                  '&text='+encodeURIComponent(webinar[1]+' webinar')+
                  '&details='+encodeURIComponent('Keyman 14 Webinar Series')+
                  '&location=https%3A%2F%2Fkeyman.com%2F14%2Fwebinar'+
                  '&dates='+icalDate(dt)+'%2F'+icalDate(dtEnd);
        a0.style.color = 'blue';
        a0.target = '_blank';
        td4.appendChild(a0);
        td4.appendChild(document.createElement('br'));

        a0 = document.createElement('a');

        var ics = [
          'BEGIN:VCALENDAR',
          'PRODID:Keyman.com',
          'VERSION:2.0',
          'BEGIN:VEVENT',
          'DTSTAMP:'+icalDate(new Date()),
          'UID:'+uuidv4(),
          'SUMMARY:'+webinar[1]+' webinar',
          'DTSTART:'+icalDate(dt),
          'DTEND:'+icalDate(dtEnd),
          'DESCRIPTION:Keyman 14 Webinar Series',
          'LOCATION:https://keyman.com/webinar',
          'END:VEVENT',
          'END:VCALENDAR'
        ].join('\r\n');

        a0.innerHTML = '.ics&nbsp;download';
        a0.href = 'data:text/calendar;charset=utf-8;base64,'+window.btoa(ics);
        a0.download = webinar[1]+'.ics';
        a0.target = '_blank';
        a0.style.color = 'blue';
        td4.appendChild(a0);
      }

      tr.appendChild(td0);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
    }
    tbody.appendChild(tr);
  }

  window.setInterval(showWebinarLink, 5000);
  showWebinarLink();
  function showWebinarLink() {
    var found = false;
    for(var i in webinars) {
      var webinar = webinars[i];
      if(typeof webinar == 'string') continue;
      var dt = new Date(Date.UTC(2021, webinar[3], webinar[4], webinar[5], webinar[6]));
      var dtEnd = new Date(dt.valueOf() + parseInt(webinar[2], 10) * 60 * 1000);
      var startOffset = Date.now() - dt.valueOf();
      var endOffset = Date.now() - dtEnd.valueOf();
      var cta = document.getElementById('webinar-cta-'+i);
      // Start showing the webinar link 10 minutes before and hide it at the end
      if(startOffset >= -10 * 60 * 1000 && endOffset < 0) {
        found = true;
        cta.style.display='block';
      } else {
        cta.style.display='none';
      }
    }

    document.getElementById('webinar-cta').style.display=found?'block':'none';
  }
</script>

[< Back to Keyman 14.0 Home](/14)
