<FONT FACE="Arial, Verdana, Helvetiva">
<B>
ASP Form-Result:
</B>
<P>
<%

		a = Request("eingabe")
		b = Request("artist")
		c = Request("zahlmethode")
		d = Request("zutat")
		e = Request("blabla")
		f = Request("widget")


		Response.Write a
		Response.Write "<P>"
		
		feld = Split(b,",")
		if UBound(feld) > -1 then
			for i=0 to UBound(feld)
				Response.Write Trim(feld(i)) & " "
			next
		end if
		Response.Write "<P>"
		
		Response.Write c
		Response.Write "<P>"
		
		feld = Split(d,",")
		if UBound(feld) > -1 then
			for i=0 to UBound(feld)
				Response.Write Trim(feld(i)) & " "
			next
		end if
		Response.Write "<P>"

		Response.Write e
		Response.Write "<P>"
		
		Response.Write f
%>

<P>
<B>
	<A HREF=test.html TARGET=xx>Testlink</A>
</B>
