<%@ Page %>
<HTML>
	<SCRIPT language="C#" runat="server">
		void Page_Load(Object o, EventArgs e) {
			// in .ASPX we must set the button WinLIKE event function here
			// in VB it is exactly the same syntax
			Button1.Attributes.Add("onClick", "submitWinLIKE_(event)");

			// print out the input result
			if (IsPostBack) {
				int val = int.Parse(TextBox1.Text) + int.Parse(TextBox2.Value);
				Label1.Text = "Sum = " + val + "<BR><BR>";
			}
		}

		void Button1_Click(Object o, EventArgs e) {
			// print out the button result
			Span1.InnerHtml = Button1.Text + "<BR><BR>";
		}    
		void Button2_Click(Object o, EventArgs e) {
			// print out the button result
			Span1.InnerHtml = Button2.Value + "<BR><BR>";
		}    
	</SCRIPT>

	<SCRIPT src="../../winlike/winman/winxtra.js"></SCRIPT>
	
	<% if (!IsPostBack) { %>
		<FONT FACE="Arial, Verdana, Helvetiva" SIZE="2">
			<B>ASP.NET: Form-POST with Server Controls, in another window with target=new_win</B>
			<BR><BR>
			Note: ASP.NET does not allow to post to another file with &lt;form action=...
			<FORM id="Form1" onSubmit="return submitWinLIKE_(event)" target="new_win" method="post" action="result.aspx" runat="server">
				<!-- here we use a .NET server control -->
				Number:	<asp:textbox id="TextBox1" runat="server" width="40px">1</asp:textbox>
				<BR>
				<!-- in comparison, this is a normal html client control, which is runs at the server -->
				Number: <input id="TextBox2" type="text" runat="server" value="2" style="WIDTH:40px">
				<BR><BR>
				<!-- here we use a .NET server control, but note, the onClick event is here a server event!!!
				     That's why we must set our submitWinLIKE_ call at the Page_Load function or any other place (f.i. on the client). -->
				<asp:button id="Button1" onClick="Button1_Click" runat="server" text="ASP button"></asp:button>
				&nbsp;
				<!-- in comparison, this is a normal html client control, which is runs at the server -->
				<input type=submit id=Button2 name=Button2 value="HTML button" onClick=submitWinLIKE_(event) runat=server onserverclick=Button2_Click>
				<BR><br>
				or <a href="javascript:submitWinLIKE_('Form1')">Submit per Script</a>
			</FORM>
		</FONT>
	<% } else { %>
		<FONT FACE="Arial, Verdana, Helvetiva"><B>ASPX Form-Result:</B><BR>
			<BR>
			<!-- this server controls placeholders will be set in the function above -->
			<asp:label id="Label1" runat="server"></asp:label>
			<span id="Span1" runat="server"></span>
			<B><A HREF="test.html" TARGET="xx">Testlink</A></B>
		</FONT>
	<% } %>
</HTML>
