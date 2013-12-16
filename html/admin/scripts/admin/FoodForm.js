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
                },
                items: [
                  {
                    xtype: "textfield",
                    name: "name",
                    fieldLabel: "name",
                    minLength: 2,
                    required: true,
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
                        {status: 1, label: 'On'}
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
                        {status: 1, label: '1 star'},
                        {status: 2, label: '2 star'},
                      ]
                    }),
                    displayField: 'label',
                    valueField: 'status',
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
                           var record = form.getRecord();
                           record.set(form.getValues());
                           console.log(record);
                           record.save({
                             success: function () {
                               
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