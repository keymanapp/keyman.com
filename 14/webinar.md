---
title: Keyman 14 Launch Webinar Series
---

[< Back to Keyman 14.0 Home](/14)

We will be holding a series of webinars all about Keyman 14 running between 29
March and 1 April 2021.

A link will be published here for access to the webinars shortly before they go
live. All webinars will be recorded and the recordings will be added here when
they are available, shortly after the webinar.

We will also announce the webinars on [Twitter](https://twitter.com/keyman) and
[Facebook](https://facebook.com/keymanapp) before they go live.

We will have some time for questions in each webinar. The 'Welcome to Keyman 14'
webinar will have an overview of the major new features in Keyman 14, and then
we'll go into a more detailed walk through the changes in each product in the
individual product webinars.

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
    <th>Calendar Links</th>
  </tr>
</thead>
<tbody id='webinar-tbody'></tbody>
</table>

<script>
  var webinars = [
    ['MD', 'Welcome to Keyman 14',  45, 2, 29, 19, 0],
    ['MD', 'Welcome to Keyman 14 (repeat)',  45, 2, 30,  8, 0],

    'Product webinars',
    ['DW', 'Keyman 14 for Android', 30, 2, 30,  9, 0],
    ['MD', 'Keyman 14 for macOS',   30, 2, 30,  9, 30],

    ['MD', 'Keyman 14 for Windows', 30, 2, 30, 19, 0],
    ['JH', 'Keyman 14 for iOS',     30, 2, 31,  8, 0],
    ['JH', 'keymanweb.com and KeymanWeb Bookmarklet', 30, 2, 31, 8, 30],
    ['EB', 'Keyman 14 for Linux',   30, 2, 31,  9, 0],

    'For keyboard developers',
    ['MD', 'Keyman Developer 14',   45, 3,  1,  8, 0],
    ['JH', 'Keyman lexical models', 45, 3,  1,  9, 0]
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

      var a0 = document.createElement('a');
      a0.innerHTML = 'Google&nbsp;Calendar';
      a0.href = 'https://www.google.com/calendar/render?action=TEMPLATE'+
                '&text='+encodeURIComponent(webinar[1]+' webinar')+
                '&details='+encodeURIComponent('Keyman 14 Webinar Series')+
                '&location=https%3A%2F%2Fkeyman.com%2F14%2Fwebinar'+
                '&dates='+icalDate(dt)+'%2F'+icalDate(dtEnd);
      a0.target = '_blank';
      td4.appendChild(a0);
      td4.appendChild(document.createElement('br'));

      var a0 = document.createElement('a');

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
      td4.appendChild(a0);


      tr.appendChild(td0);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
      tr.appendChild(td4);
    }
    tbody.appendChild(tr);
  }
</script>

[< Back to Keyman 14.0 Home](/14)
