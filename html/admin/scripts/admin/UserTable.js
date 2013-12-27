Ext.define("MyDesktop.UserTable", {
  extend: "Ext.ux.desktop.Module",
  id: "usertable",
  init: function () {
    this.launcher = {
      text: "User Managment",
      iconCls: "notepad"
    };
  },
  createWindow: function () {
    var desktop = this.app.getDesktop();
    var win = desktop.getWindow("usertable");
    
    var userstore = Ext.create("Ext.ux.store.User");
    
    if (!win) {
      win = desktop.createWindow({
        title: "User Managment",
        id: "usertablelist",
        width: "90%",
        iconCls: "notepad",
        animCollapse: false,
        border: false,
        hideMode: "offsets",
        layout: "fit",
        items: [
          Ext.create("Ext.grid.Panel", {
            columns: [
              {header: "Name", dataIndex: "name"},
              {header: "Email", dataIndex: "email"},
              {header: "Adatar", dataIndex: "avadar", 
                renderer: function (value) {
                  return "<img src='"+value+"' />";
                }
              },
              {header: "Phone", dataIndex: "phone"},
              {header: "Register", dataIndex: "created"},
              {header: "Last login", dataaIndex: "lastlogin"},
              {
                xtype: "actioncolumn",
                header: "Action",
                items: [
                  {icon: "images/edit.png", tooltip: 'Edit this user', 
                    handler: function () {
                      Ext.Msg.alert("Edit ?");
                    }
                  },
                  {icon: "images/delte.png", tooltip: "Delete this user", 
                    handler: function () {
                      Ext.Msg.alert("Delte ?");
                    }
                  }
                ]
              }
            ],
            store: userstore,
            emptyText: "Don't have user register in our system",
            listeners: {
              beforerender: function (grid) {
                // TODO::
              },
              select: function (grid, record, index, opts) {
                // TODO::
              }
            }
          }),
        ]
      });
    }
  }
});