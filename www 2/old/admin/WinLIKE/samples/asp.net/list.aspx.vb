Imports System
Imports System.Web.UI
Imports System.Web.UI.WebControls
Imports System.Data
Imports System.Data.SqlClient

Public Class list
    Inherits System.Web.UI.Page

    <System.Diagnostics.DebuggerStepThrough()> Private Sub InitializeComponent()
    End Sub

    Protected WithEvents grid As System.Web.UI.WebControls.DataGrid
    Protected WithEvents HyperLink1 As HyperLink

    Private designerPlaceholderDeclaration As System.Object

    Private Sub Page_Init(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Init
        InitializeComponent()
    End Sub

    Private Sub Page_Load(ByVal sender As System.Object, ByVal e As System.EventArgs) Handles MyBase.Load
        If Not Page.IsPostBack Then
            If Session("Page") Then
                grid.CurrentPageIndex = Session("Page")
            End If
            BindData()
        End If
    End Sub

    Sub grid_Page(ByVal Sender As Object, ByVal E As DataGridPageChangedEventArgs)
        grid.CurrentPageIndex = E.NewPageIndex
        Session("Page") = E.NewPageIndex
        BindData()
    End Sub

    Sub BindData()
        Dim sql As String = "SELECT TOP 80 o.OrderID, o.Freight, c.CompanyName FROM Orders o INNER JOIN Customers c ON o.CustomerID = c.CustomerID ORDER BY o.orderID"
        Dim cn As New SqlConnection("server=localhost;database=northwind;uid=sa;pwd=;")
        Dim da As New SqlDataAdapter(sql, cn)
        Dim ds As New DataSet
        da.Fill(ds)
        grid.DataSource = ds
        grid.DataBind()
    End Sub

End Class
