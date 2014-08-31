//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\

	function popup( filename, title, width, height, x, y, scrollbars, statusbar, resizable ) {
		if( x=='c' ) x = ( screen.width - width ) / 2;
		if( y=='c' ) y = ( screen.height - height ) / 2;
		
		if( scrollbars == null ) scrollbars = 'yes';
		if( statusbar == null ) statusbar = 'no';
		if( resizable == null ) resizable = 'no';
		
		NewWindow = window.open( filename, title, "status=" + statusbar + ",scrollbars=" + scrollbars + 
			",width=" + width + ",height=" + height + ",left=" + x + ",top=" + y + ",resizable=" + resizable );
               
		if( !NewWindow.opener ) NewWindow.opener = self;
		//NewWindow.focus();
	}


	var pi = Math.PI;		//pi to 15sf
	function square(x) { return (x*x); }
	function sqrt(x) { return Math.sqrt(x); }
	function round(x) { return Math.round(x); }
	function rand(x,y) { return (round(Math.random()*(y-x)) + x); }
	function degToRad(x) { return ( x/(360/(2*pi)) ); }
	function radToDeg(x) { return ( x*(360/(2*pi)) ); }
	function sin(x) { return Math.sin(x); }
	function cos(x) { return Math.cos(x); }
	function tan(x) { return Math.tan(x); }

	function atan(s,t) {
		if( s == 0.0 && t > 0.0)
			angle = 90.0;
		else if(s == 0.0 && t < 0.0) 
			angle = 270.0;
		else if (s < 0.0 ) 
			angle = 180.0 + radToDeg(Math.atan(t/s));
		else if (s > 0.0 && t < 0.0)
			angle = 360.0 + radToDeg(Math.atan(t/s));
		else {
			if(s==0.0) s=0.00001;
			angle = radToDeg(Math.atan(t/s));
		}

		if(angle < 0.0) angle += 360.0;
        
		return angle;
	}
	function abs(x) {
		if(x < 0) x = x * -1;
		return x;
	}


	function precache(url) {
		var im = new Image();
		im.src = url;
		return im;
	}

	
	function getMonthName(m) {
		switch (m) { 
			case 0: return "January"; break; 
			case 1: return "February"; break; 
			case 2: return "march"; break; 
			case 3: return "April"; break; 
			case 4: return "May"; break; 
			case 5: return "June"; break; 
			case 6: return "July"; break; 
			case 7: return "August"; break; 
			case 8: return "September"; break; 
			case 9: return "October"; break;
			case 10: return "November"; break; 
			case 11: return "December"; break;  
			default: return "invalid month"; 
		} 
	}