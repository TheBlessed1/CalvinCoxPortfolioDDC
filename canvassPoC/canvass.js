//Defining Globals
var CANVAS_WIDTH;
var CANVAS_HEIGHT;
var LINE_WIDTH;
var RADIUS;

/* draws the clock on the canvas; this function is meant to be called repetitively
 * input N/A
 * output N/A */
 function drawClock()
 {
 	var canvas = document.getElementById("clockCanvas");
 	var ctxt = canvas.getContext("2d");
 	
 	//clear the canvas
 	ctxt.clearRect(0, 0, canvas.width, canvas.height);

 	//draw hands
 	drawHands(ctxt);
 	
 	//draw hashes
 	drawHashes(ctxt);
 	
 	//draw outer circle
 	drawOuterCircle(ctxt);
 }
 
 /* draws a line on the canvas
 * input: pointer to context
 * input: string stroke style of the line
 * input: integer line width
 * input: integer starting with x coordinate
 * input: integer starting y coordinate
 * input: integer ending x coordinate
 * input: integer ending y coordinate
 * ctxtoutput: N/A */
 function drawLine(ctxt, strokeStyle, lineWidth, startX, startY, endX, endY)
 {
 	ctxt.lineWidth = lineWidth;
 	ctxt.beginPath();
 	ctxt.moveTo(startX, startY);
 	ctxt.strokeStyle = strokeStyle;
 	ctxt.lineTo(endX, endY);
 	ctxt.stroke();
 }
 
function drawHands(ctxt)
{
	//move the origin (0,0) to the center of the block
	ctxt.save();
	ctxt.translate(CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
	
	//get the current time
	var now = new Date();
	var hour = now.getHours() + now.getMinutes() / 60.0; //we use a fractional hour to gradually move the hour hand
	var minute = now.getMinutes();
	var second = now.getSeconds();
	
	//calculate the end point of the hour hand
	var thetaHour = (Math.PI * hour) / 6.0;
	var xHour = Math.floor((-0.65 * RADIUS) * Math.cos(thetaHour + Math.PI /2.0));
	var yHour = Math.floor((-0.65 * RADIUS) * Math.sin(thetaHour + Math.PI /2.0));
	
	//calculate the end point of the minute hand
	var thetaMinute = (Math.PI * minute) / 30.0;
	var xMinute = Math.floor((-0.8 * RADIUS) * Math.cos(thetaMinute + Math.PI /2.0));
	var yMinute = Math.floor((-0.8 * RADIUS) * Math.sin(thetaMinute + Math.PI /2.0));
	
	//calculate the end point of the Second hand
	var thetaSecond = (Math.PI * second) / 30.0;
	var xSecond = Math.floor((-0.8 * RADIUS) * Math.cos(thetaSecond + Math.PI /2.0));
	var ySecond = Math.floor((-0.8 * RADIUS) * Math.sin(thetaSecond + Math.PI /2.0));
	
	//draw the hands on the canvas
	drawLine(ctxt, "black", LINE_WIDTH,	0,0, xHour, yHour);
	drawLine(ctxt, "black", LINE_WIDTH,	0,0, xMinute, yMinute);
	drawLine(ctxt, "red", LINE_WIDTH / 2.0, 0,0, xSecond, ySecond);
	
	//decentralize origin
	ctxt.restore();
}

function drawHashes(ctxt)
{
	ctxt.save();
	ctxt.translate(CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2);
	
	for(var i = 0; i < 60; i++)
	{
		//calculate the starting & ending points of the hashes
		var theta = (Math.PI * i) / 30.0;
		var startX = Math.floor((0.85 * RADIUS) * Math.cos(theta));
		var startY = Math.floor((-0.85 * RADIUS) * Math.sin(theta));
		var endX = Math.floor(RADIUS * Math.cos(theta));
		var endY = Math.floor(-RADIUS * Math.sin(theta));
		
		//set the line width to 25%, unless it's on the 5 minute mark
		var lineWidth = Math.floor(LINE_WIDTH / 4.0);
		if(i % 5 == 0)
		{
			lineWidth = LINE_WIDTH;
		}
		drawLine(ctxt, "black", lineWidth, startX, startY, endX, endY);
	}
	ctxt.restore();
}

/* resizes clock
 * input: N/A
 * output: N/A*/
function resize()
{
	//start with 95% of the viewport
	var newWidth = Math.floor(0.95 * window.innerWidth);
	var newHeight = Math.floor(0.95 * window.innerHeight);
	
	//make a square canvas using the smaller of the new width and height
	if(newWidth < newHeight)
	{
		newHeight = newWidth;
	}
	else
	{
		newWidth = newHeight;
	}
	
	// if edges are odd, decrease the size by one pixel
	if(newWidth % 2 == 1)
	{
		newWidth--;
		newHeight--;
	}
	
	//resize the canvas and load variables
	var canvas = document.getElementById("clockCanvas");
	canvas.width = newWidth;
	canvas.height = newHeight;
	loadVariables();
}

/* draws the outer circle of the clock
*input: pointer to context
*output: N/A */
function drawOuterCircle(ctxt)
{
	ctxt.moveTo(0, 0);
	ctxt.strokeStyle = "blue";
	ctxt.beginPath();
	ctxt.arc(CANVAS_WIDTH / 2, CANVAS_HEIGHT / 2, RADIUS, 0.0, 2.0 * Math.PI);
	ctxt.lineWidth = LINE_WIDTH;
	ctxt.stroke();
}

function loadVariables()
{
	CANVAS_WIDTH = document.getElementById("clockCanvas").width;
	CANVAS_HEIGHT = document.getElementById("clockCanvas").height;
	LINE_WIDTH = Math.floor(0.025 * CANVAS_WIDTH); //2.5% of the canvas width, rounded down
	RADIUS = Math.floor(0.475 * CANVAS_WIDTH); //47.5% of the canvas width, rounded down
}

/*sets up the clock to redraw every second
 * input: N/A
 * output: N/A */
function setup()
{
	//window.setInterval() will call the draw method every 1000 ms(1 sec)
	loadVariables();
	drawClock();
	window.setInterval(drawClock, 1000);
}