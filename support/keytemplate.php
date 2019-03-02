<?php
  require_once('includes/template.php');
  
  // Required
  head([
    'title' =>'Key Templates',
    'css' => ['template.css','feature-grid.css','app-store-links.css'],
    'showMenu' => true,
  ]);           
?>
<h2 class="red underline">Key Templates</h2>

<script>

/**
 * Draws a rounded rectangle using the current state of the canvas. 
 * If you omit the last three params, it will draw a rectangle 
 * outline with a 5 pixel border radius 
 * http://stackoverflow.com/questions/1255512/how-to-draw-a-rounded-rectangle-on-html-canvas
 * @param {CanvasRenderingContext2D} ctx
 * @param {Number} x The top left x coordinate
 * @param {Number} y The top left y coordinate 
 * @param {Number} width The width of the rectangle 
 * @param {Number} height The height of the rectangle
 * @param {Number} radius The corner radius. Defaults to 5;
 * @param {Boolean} fill Whether to fill the rectangle. Defaults to false.
 * @param {Boolean} stroke Whether to stroke the rectangle. Defaults to true.
 */
function roundRect(ctx, x, y, width, height, radius, fill, stroke) {
  if (typeof stroke == "undefined" ) {
    stroke = true;
  }
  if (typeof radius === "undefined") {
    radius = 5;
  }
  ctx.beginPath();
  ctx.moveTo(x + radius, y);
  ctx.lineTo(x + width - radius, y);
  ctx.quadraticCurveTo(x + width, y, x + width, y + radius);
  ctx.lineTo(x + width, y + height - radius);
  ctx.quadraticCurveTo(x + width, y + height, x + width - radius, y + height);
  ctx.lineTo(x + radius, y + height);
  ctx.quadraticCurveTo(x, y + height, x, y + height - radius);
  ctx.lineTo(x, y + radius);
  ctx.quadraticCurveTo(x, y, x + radius, y);
  ctx.closePath();
  if (stroke) {
    ctx.stroke();
  }
  if (fill) {
    ctx.fill();
  }        
}

function cleanFileName(s) {
  s = s.replace(/ |\+/g,'-');
  s = s.replace('___','Spacebar');
  s = s.replace('__','Plus');
  return s.replace(/[^\w. -]/g,'_');
}

function refreshImage() {
  var s = $('#text').val();
  var keys = s.split(/( |\+)/);

  var canvas = $('#image')[0];
  var context = canvas.getContext('2d');
  
  // Adjust scale as needed
  
  var scale = parseFloat($('#scale').val());
  if(isNaN(scale)) scale = 1;
  
  // Defined key metrics, default scale = 38px high for keys
  
  var margin = 6, w = 40, h = 38, radius = 7, borderWidth = 1;
  
  // Calculated metrics
  
  margin *= scale;
  w *= scale;
  h *= scale;
  radius *= scale;
  borderWidth *= scale;
  
  var x = margin, y = margin;
  var yt = (h - h/2) / 2 + h/2 - h/12;
  context.font = (h/2) + 'px '+$('#font').val();

  // Measure the text first and size the canvas accordingly
  
  for(var i = 0; i < keys.length; i+=2) {
    if(i > 0 && keys[i-1] == '+') {
      x = x - margin - margin/2 + context.measureText('+').width + margin/2;
    }

    var ch = keys[i];
    ch = ch.replace('___', '                                    ');
    ch = ch.replace('__', '+');
    if(ch == '') continue;
    
    var chm = context.measureText(ch);
    var chw = Math.max(w, chm.width + 12);

    x += chw + margin + margin;
  }
  
  canvas.width = x - margin;
  canvas.height = h + 2 * margin;
  
  // Now draw, must reset font after canvas resize

  x = margin;
  context.font = (h/2) + 'px '+$('#font').val();

  for(var i = 0; i < keys.length; i+=2) {
    if(i > 0 && keys[i-1] == '+') {
      context.fillStyle = 'black';
      context.fillText('+', x - margin - margin/2, y + yt);
      x = x - margin - margin/2 + context.measureText('+').width + margin/2;
    }

    var ch = keys[i];
    ch = ch.replace('____', '+');
    ch = ch.replace('___', '                                    ');
    ch = ch.replace('__', ' ');
   
    if(ch == '') continue;
    
    var chm = context.measureText(ch);
    var chw = Math.max(w, chm.width + 12);

    var g = context.createLinearGradient(x, y, x+chw, y+h);
    g.addColorStop(1, '#ccccd4');
    g.addColorStop(0, '#eeeef6');
    context.fillStyle = g;
    context.lineWidth = borderWidth;
    roundRect(context, x, y, chw, h, radius, radius);
    
    context.fillStyle = 'black';
    context.fillText(ch, x + (chw - chm.width) / 2, y + yt);
    x += chw + margin + margin;
  }
    
  var data = $('#image')[0].toDataURL();
  if(data && data.length > 6) {
    $('#save')[0].src = data;
    $('#saveLink').attr('download', 'key-'+cleanFileName(s).toLowerCase()+'.png').attr('href', data);
  } else {
    $('#save')[0].src = '';
    $('#saveLink').attr('download', '').attr('href', '#');
  }
}

</script>

<div id='keyspace' style='background:white; border: black; width: 100%; height: 200px'>
  <canvas id='image' width='900' height='200'></canvas>
</div>

<br />

<p>
  Keys: <input id='text' type='text' onchange='refreshImage()' onkeyup='refreshImage()'> 
  Scale: <input id='scale' type='text' size='4' onchange='refreshImage()' onkeyup='refreshImage()' value='1'> 
  Font: <input id='font' type='text' size='16' onchange='refreshImage()' onkeyup='refreshImage()' value='Calibri'>
</p>
<p>Separate keys with space or +. Use __ for a space on a key; ____ to represent [+], and ___ to represent [spacebar].</p>
<p>Click image below to save to disk:</p>
<a id='saveLink' href='#' download='key.png'><img id='save'></a>
