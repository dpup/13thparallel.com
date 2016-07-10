//=======================================================\\
//                    13thparallel.org                   \\
//                   Copyright (c) 2002                  \\ 
//   see (13thparallel.org/?title=about) for more info   \\
//=======================================================\\


//=============================================================\\
//== functions:                                              ==\\
//==    GetCookie(name,[defaultValue])                       ==\\
//==                    - retrieves the value  of a cookie   ==\\
//==                      (returns null if it doesn't exist) ==\\
//==    SetCookie(name, value, [expires])                    ==\\
//==                    - sets the cookie name with value    ==\\ 
//==                      (takes optional argument expires   ==\\
//==                      which is the time in hours till it ==\\
//==                      expires)                           ==\\
//==    DeleteCookie(name)                                   ==\\
//==                    - removes the cookie "name"          ==\\
//=============================================================\\


function GetCookie (name, d) {
	if (!d) var d = null;
	var arg = name + "=";
	var alen = arg.length;
	var clen = document.cookie.length;
	var i = 0;
	while (i < clen) {
		var j = i + alen;
		if (document.cookie.substring(i, j) == arg) {
			var endstr = document.cookie.indexOf (";", j);
			if (endstr == -1) endstr = document.cookie.length;
			return unescape(document.cookie.substring(j, endstr));
 		}
		i = document.cookie.indexOf(" ", i) + 1;
		if (i == 0) break;
	}
	return d;
}

function SetCookie (name, value, expires) {
	if (expires) {
		var exp = new Date();
		exp.setTime(exp.getTime() + (expires*60*60*1000));
		expires = exp;
	}
	document.cookie = name + "=" + escape(value) + ((expires == null) ? "" : ("; expires=" + expires.toGMTString()));
}

function DeleteCookie (name) {
	var exp = new Date();
	exp.setTime (exp.getTime() - 1000);
	var cval = GetCookie (name);
	document.cookie = name + "=" + cval + "; expires=" + exp.toGMTString();
}

// end
