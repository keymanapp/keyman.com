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

  var tbody = document.getElementById('webinar-tbody');
  for(var i in webinars) {
    var webinar = webinars[i];
    var tr = document.createElement('tr');
    if(typeof webinar == 'string') {
      var td0 = document.createElement('th');
      td0.colSpan = 4;
      td0.innerText = webinar;
      tr.appendChild(td0);
    } else {
      var td0 = document.createElement('td');
      var td1 = document.createElement('td');
      var td2 = document.createElement('td');
      var td3 = document.createElement('td');
      var dt = new Date(Date.UTC(2021, webinar[3], webinar[4], webinar[5], webinar[6]));
      td0.innerText = webinar[1];
      td1.innerText = webinar[2];
      td2.innerText = dt.toLocaleString([], {
          timeZoneName: 'short',
          weekday: 'short',
          year: 'numeric',
          month: 'short',
          day: 'numeric',
          hour: '2-digit',
          minute:'2-digit'
        });
      td3.innerText = dt.toLocaleString([], {
        timeZone: 'UTC',
        timeZoneName: 'short',
        weekday: 'short',
        year: 'numeric',
        month: 'short',
        day: 'numeric',
        hour: '2-digit',
        minute:'2-digit'
      });
      tr.appendChild(td0);
      tr.appendChild(td1);
      tr.appendChild(td2);
      tr.appendChild(td3);
    }
    tbody.appendChild(tr);
  }
</script>

[< Back to Keyman 14.0 Home](/14)
