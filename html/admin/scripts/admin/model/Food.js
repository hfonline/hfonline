Ext.define("Ext.ux.model.Food", {
  extend: "Ext.data.Model",
  fields: [
    {
      name: 'food_id',
      type: 'int',
    },
    {
      name: 'name',
      type: 'string',
      minLength: 2
    }, 
    {
      name: 'summary',
      type: 'string',
    },
    {
      name: 'price',
      type: 'int',
    },
    {
      name: 'star',
      typ: 'int',
    },
    {
      name: 'status',
      type: 'int',
    },
    {
      name: 'description',
      type: 'string'
    }
  ],
  idProperty: "food_id",
  proxy: {
    type: 'ajax',
    reader: {
      type: 'json',
      root: "data",
    },
    writer: {
      type: "json",
      writeAllFields: true,
    },
    api: {
      create: "/food/add",
      update: "/food/update",
      read: "/food/get",
      destroy: "/food/delete"
    },
    listeners: {
      exception: function (proxy, response, options) {
        proxy.serverResponse = response;
      }
    }
  },
});