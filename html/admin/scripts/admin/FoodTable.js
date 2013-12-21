Ext.define("MyDesktop.FoodTable", {
  extend: "Ext.ux.desktop.Module",
  id: "foodtable",
  init: function () {
    this.launcher = {
      text: "Food Managment",
      iconCls: "nodepad"
    };
  },
  createWindow: function () {
    var desktop = this.app.getDesktop();
    var win = desktop.getWindow('foodform');
    var foodStore = Ext.create("Ext.ux.store.FoodList");
    
    if (!win) {
       win = desktop.createWindow({
          title: "Food Managment",
          id: "foodlist",
          width: "90%",
          iconCls: 'notepad',
          animCollapse:false,
          border: false,
          //defaultFocus: 'notepad-editor', EXTJSIV-1300

          // IE has a bug where it will keep the iframe's background visible when the window
          // is set to visibility:hidden. Hiding the window via position offsets instead gets
          // around this bug.
          hideMode: 'offsets',
          layout: 'hbox',
          items: [
            Ext.create("Ext.grid.Panel", {
              flex: 4,
              columns: [
                {header: "Id", dataIndex: "food_id"},
                {header: "Name",dataIndex: "name"},
                {header: "Price", dataIndex: "price"},
                {header: "Summary", dataIndex: "summary"},
                {header: "Star", "dataIndex": "star"}, 
                {
                  header: "Status", 
                  dataIndex: "status",
                  renderer: function (value) {
                    var labels = {1: "On", 2: "Off", 3: "Delete"};
                    return labels[value];
                  }
                },
                {
                  xtype: "actioncolumn",
                  items: [
                    {
                      icon: "images/edit.png",
                      tooltip: "Edit this food",
                      handler: function (grid, rowindex, colindex) {
                        var record = grid.store.getAt(rowindex);
                        var form = grid.up("#foodlist").down("#editformpanel");
                        form.getForm().loadRecord(record);
                      },
                    },
                    {
                      icon: "images/delete.png",
                      tooltip: "Delete this food",
                      handler: function (grid, rowindex, colindex) {
                        Ext.Msg.confirm("Delte food", "Are you sure delete ?", function (button) {
                          if (button == 'yes') {
                            grid.store.getAt(rowindex).destroy();
                            grid.store.removeAt(rowindex);
                          }
                          else {
                            // Nothing to do;
                          }
                        }, this);
                      },
                    }
                  ],
                  header: "Action"
                }
              ],
              store: foodStore,
              dockedItems: [
                {
                  xtype: "pagingtoolbar",
                  store: foodStore,
                  dock: "bottom",
                  displayInfo: true
                }
              ],
              emptyText: "No food created yet",
              listeners: {
                beforerender: function (grid) {
                  var store = grid.store;
                  store.load({
                    scope: this,
                    callback: function (records, op, success) {
                      // TODO::
                    }
                  });
                },
                select: function (grid, record, index, opts) {
                  //console.log(record);
                }
              }
            }),
              Ext.create("Ext.form.Panel", {
                flex: 2,
                listeners: {
                  afterrender: {
                    fn: function (cmp) {
                      cmp.loadRecord(Ext.create("Ext.ux.model.Food"));
                    },
                    score: this
                  }
                },
                maxHeight: 500,
                autoScroll: true,
                id: "editformpanel",
                fieldDefaults: {
                  labelAlign: "top",
                  labelWidth: 90,
                  anchor: '100%',
                  msgTarget: "under",
                  allowBlank: false
                },
                items: [
                  {
                    xtype: "textfield",
                    name: "name",
                    fieldLabel: "name",
                    minLength: 2,
                  },
                  {
                   xtype: 'textfield',
                   name: 'price',
                   fieldLabel: "Price",
                   regex: /^[0-9\.]+$/,
                   anchor: '40%',
                  },
                  {
                    xtype: "textarea",
                    name: 'summary',
                    grow: true,
                    fieldLabel: "Summary",
                  },
                  {
                    xtype: "htmleditor",
                    name: 'description',
                    fieldLabel: "Description",                    
                  },
                  {
                    xtype: "combobox",
                    name: 'status',
                    fieldLabel: "Status",
                    store: Ext.create("Ext.data.Store", {
                      fields: [{type: 'int', name: 'status'}, {type: 'string', name: 'label'}],
                      data: [
                        {status: 1, label: 'On'},
                        {status: 2, label: "Off"},
                        {status: 3, label: "Deleted"}
                      ]
                    }),
                    displayField: 'label',
                    valueField: 'status',
                    anchor: '20%'
                  },
                  {
                    xtype: "combobox",
                    name: 'star',
                    fieldLabel: "Star",
                    store: Ext.create("Ext.data.Store", {
                      fields: [{type: 'int', name: 'star'}, {type: 'string', name: 'label'}],
                      data: [
                        {star: 1, label: '1 star'},
                        {star: 2, label: '2 star'},
                      ]
                    }),
                    displayField: 'label',
                    valueField: 'star',
                    anchor: '20%'
                  },
                  {
                    xtype: 'hidden',
                    name: 'uid',
                  }
                ],
                buttons: [{
                       text: 'Submit',
                       handler: function() {
                         var form = this.up('form').getForm();
                         var model = form.getRecord();
                         if (form.isValid()) {
                           var record = form.getRecord();
                           record.set(form.getValues());
                           console.log(record);
                           record.save({
                             success: function (model) {
                               var proxy = model.getProxy();
                               Ext.Msg.alert("status", "Updated Success");
                             },
                             failure: function (model) {
                               var proxy = model.getProxy();
                               var resp = Ext.JSON.decode(proxy.serverResponse.responseText);
                               Ext.Msg.alert("Error", resp["message"]);
                             }
                           });
                         }
                       }
                   }]
              })
          ]
       });
    }
    
    return win;
  }
});