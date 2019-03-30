Imports System
Imports System.Web.UI
Imports System.Web.UI.WebControls
Imports System.Data
Imports System.Data.SqlClient

Public Class edit
    Inherits System.Web.UI.Page

    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()
    End Sub

    Protected WithEvents btnUpdate As System.Web.UI.WebControls.Button
    Protected WithEvents lblMessage As System.Web.UI.WebControls.Label
    Protected WithEvents txtOrderID As System.Web.UI.WebControls.TextBox
    Protected WithEvents dropCustomers As System.Web.UI.WebControls.DropDownList
    Protected WithEvents txtShipCity As System.Web.UI.WebControls.TextBox
    Protected WithEvents txtShipAddress As System.Web.UI.WebControls.TextBox
    Protected WithEvents Label2 As System.Web.UI.WebControls.Label
    Protected WithEvents Label3 As System.Web.UI.WebControls.Label
    Protected WithEvents Label4 As System.Web.UI.WebControls.Label
    Protected WithEvents Label5 As System.Web.UI.WebControls.Label

    Private designerPlaceholderDeclaration As System.Object

    Private Sub Page_Init(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Init
        InitializeComponent()
    End Sub

    Dim sql As String
    Dim cn As SqlConnection
    Dim cmd As SqlCommand
    Dim read As SqlDataReader

    Private Sub Page_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        cn = New SqlConnection("server=localhost;database=northwind;uid=sa;pwd=;")
        If Not Page.IsPostBack Then
            LoadData()
        End If
    End Sub

    Sub LoadData()
        sql = "SELECT OrderID, ShipAddress, ShipCity, CustomerID FROM Orders WHERE OrderID=" + Request.QueryString("OrderID")
        cmd = New SqlCommand(sql, cn)
        cn.Open()
        read = cmd.ExecuteReader()
        read.Read()
        txtOrderID.Text = read.Item(0)
        txtShipAddress.Text = read.Item(1)
        txtShipCity.Text = read.Item(2)
        Dim remember = read.Item(3)
        read.close()

        sql = "SELECT CustomerID, CompanyName FROM Customers"
        cmd = New SqlCommand(sql, cn)
        dropCustomers.DataSource = cmd.ExecuteReader()
        dropCustomers.DataBind()
        cn.Close()
        dropCustomers.SelectedValue = remember
    End Sub

    Private Sub btnUpdate_Click(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles btnUpdate.Click
        sql = "UPDATE Orders SET ShipCity='" + txtShipCity.Text + "', ShipAddress='" + txtShipAddress.Text + "', CustomerID='" + dropCustomers.SelectedValue + "' WHERE OrderID=" + txtOrderID.Text
        cmd = New SqlCommand(sql, cn)
        Try
            cn.Open()
            cmd.ExecuteNonQuery()
            Response.Write("<SCRIPT>" + _
                                "parent.WinLIKE.openaddress('samples/asp.net/list.aspx',null,'listwin');" + _
                                "parent.WinLIKE.windows[parent.WinLIKE.searchwindow('editwin')].close();" + _
                           "</SCRIPT>")
        Catch er As Exception
            lblMessage.Text = er.Message
        Finally
            cn.Close()
        End Try
    End Sub
End Class
