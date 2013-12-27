Ext.define("MyDesktop.FoodForm", {
  extend: "Ext.ux.desktop.Module",
  
  id: "foodform",
  
  init: function () {
    this.launcher = {
      text: "Add Food",
      iconCls: "nodepad"
    };
  },
  
  createWindow: function () {
    var desktop = this.app.getDesktop();
    var win = desktop.getWindow('foodform');
    if(!win){
        win = desktop.createWindow({
            id: 'foodform',
            title:'Add Food',
            width:600,
            iconCls: 'notepad',
            animCollapse:false,
            border: false,
            //defaultFocus: 'notepad-editor', EXTJSIV-1300

            // IE has a bug where it will keep the iframe's background visible when the window
            // is set to visibility:hidden. Hiding the window via position offsets instead gets
            // around this bug.
            hideMode: 'offsets',

            layout: 'fit',
            items: [
              Ext.create("Ext.form.Panel", {
                listeners: {
                  afterrender: {
                    fn: function (cmp) {
                      // TODO::
                      cmp.loadRecord(Ext.create("Ext.ux.model.Food"));
                    },
                    score: this
                  }
                },
                maxHeight: 500,
                autoScroll: true,
                id: "addformpanel",
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
                   xtype: 'numberfield',
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
                    xtype: "filefield",
                    name: 'photo',
                    fieldLabel: "Photo",
                    buttonText: "select photo..."
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
                         var model = this.up('form').model;
                         if (form.isValid()) {
                           
                           // 保存 Record 
                           var record = form.getRecord();
                           record.set(form.getValues());
                           record.save({
                             success: function (model) {
                               var proxy = model.getProxy();
                               
                               // 上传文件
                               form.loadRecord(model)
                               form.submit({
                                 url: 'food/uploadimage',
                                 waitMsg: "Uploading photo",
                                 sucess: function (fp, o) {
                                   Ext.Msg.alert("Success", "Added Food success");
                                 }
                               });
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
            ],

        });
    }
    return win;
  }
});