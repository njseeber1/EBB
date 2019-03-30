<%@ Page Language="vb" AutoEventWireup="false" src="list.aspx.vb" Inherits="list"%>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
	<HEAD>
		<title>Order Listview</title>
		<meta content="Microsoft Visual Studio .NET 7.1" name="GENERATOR">
		<meta content="Visual Basic .NET 7.1" name="CODE_LANGUAGE">
		<meta content="JavaScript" name="vs_defaultClientScript">
		<meta content="http://schemas.microsoft.com/intellisense/ie5" name="vs_targetSchema">
	</HEAD>
	<body MS_POSITIONING="GridLayout">
		<form id="Form1" runat="server">
			<asp:datagrid id="grid" runat="server" AutoGenerateColumns="False" BorderColor="#DEDFDE" ForeColor="Black" BackColor="White" BorderWidth="1px" BorderStyle="None" GridLines="Vertical" CellPadding="4" width="100%" PageSize="5" AllowPaging="True" Font-Names="Arial" Font-Size="Smaller"
				OnPageIndexChanged="grid_Page">
				<AlternatingItemStyle BackColor="White"></AlternatingItemStyle>
				<ItemStyle BackColor="#F7F7DE"></ItemStyle>
				<HeaderStyle Font-Bold="True" ForeColor="White" BackColor="#FF8080"></HeaderStyle>
				<Columns>
					<asp:HyperLinkColumn
						Target="editwin"
						DataNavigateUrlField="OrderID"
						DataNavigateUrlFormatString="edit.aspx?OrderID={0}"
						DataTextField="OrderID"
						HeaderText="Order Number">
					</asp:HyperLinkColumn>
					<asp:BoundColumn DataField="CompanyName" HeaderText="Company"></asp:BoundColumn>
					<asp:BoundColumn DataField="Freight" HeaderText="Freight"></asp:BoundColumn>
				</Columns>
				<PagerStyle HorizontalAlign="Right" ForeColor="Black" BackColor="#E0E0E0" Mode="NumericPages"></PagerStyle>
			</asp:datagrid>
		</form>
	</body>
</HTML>
