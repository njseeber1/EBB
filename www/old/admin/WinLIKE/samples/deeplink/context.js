if (self.location==top.location) {
	file = location.href.substring(7);
	alert(file);
	file = file.substring(file.indexOf("/")+1);
	alert(file);
	top.location.href = "../../19_sample_deeplink.html?WinLIKE_Deep="+'"'+"var%20j=new%20WinLIKE.window('',365,240,300,300,11);j.Nam='mywin';j.Ski='light';j.Adr='"+file+"';WinLIKE.addwindow(j,true);"+'"';
}