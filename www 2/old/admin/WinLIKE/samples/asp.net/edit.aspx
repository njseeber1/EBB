<%@ Page Language="vb" AutoEventWireup="false" src="edit.aspx.vb" Inherits=".edit"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>Order Details</title>
		<meta content="True" name="vs_showGrid">
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="Visual Basic .NET 7.1" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
	</HEAD>
	<body MS_POSITIONING="GridLayout">
		<form id="form1" runat="server">
			<asp:Label id="Label2" style="Z-INDEX: 106; LEFT: 32px; POSITION: absolute; TOP: 32px" runat="server" Width="104px" Font-Names="Arial" Font-Size="Smaller">Order Number</asp:Label>
			<asp:Label id="Label3" style="Z-INDEX: 108; LEFT: 32px; POSITION: absolute; TOP: 64px" runat="server" Width="104px" Font-Names="Arial" Font-Size="Smaller">Company</asp:Label>
			<asp:Label id="Label4" style="Z-INDEX: 109; LEFT: 32px; POSITION: absolute; TOP: 96px" runat="server" Width="104px" Font-Names="Arial" Font-Size="Smaller">Shipping Address</asp:Label>
			<asp:Label id="Label5" style="Z-INDEX: 110; LEFT: 32px; POSITION: absolute; TOP: 128px" runat="server" Width="104px" Font-Names="Arial" Font-Size="Smaller">Shipping City</asp:Label>
			<asp:textbox id="txtOrderID" style="Z-INDEX: 100; LEFT: 152px; POSITION: absolute; TOP: 24px" runat="server" Enabled="False"></asp:textbox>
			<asp:dropdownlist id="dropCustomers" style="Z-INDEX: 104; LEFT: 152px; POSITION: absolute; TOP: 56px" runat="server"
				DataValueField="CustomerID"
				DataTextField="CompanyName">
			</asp:dropdownlist>
			<asp:textbox id="txtShipAddress" style="Z-INDEX: 105; LEFT: 152px; POSITION: absolute; TOP: 88px" runat="server"></asp:textbox>
			<asp:textbox id="txtShipCity" style="Z-INDEX: 101; LEFT: 152px; POSITION: absolute; TOP: 120px" runat="server"></asp:textbox>
			<asp:button id="btnUpdate" style="Z-INDEX: 102; LEFT: 152px; POSITION: absolute; TOP: 152px" runat="server" Text="Save" Width="72px"></asp:button>
			<asp:label id="lblMessage" style="Z-INDEX: 103; LEFT: 32px; POSITION: absolute; TOP: 192px" runat="server" Width="376px" Font-Names="Arial" Font-Size="Smaller" ForeColor="Red"></asp:label>
		</form>
		<SCRIPT>
			try
			{	// try to set the focus of an element of the window
				document.getElementById("dropCustomers").focus();
			}
			catch (everything) {}
		</SCRIPT>
	</body>
</HTML>
