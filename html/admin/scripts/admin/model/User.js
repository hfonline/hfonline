Ext.define("Ext.ux.model.User", {
  extend: "Ext.data.Model",
  fields: [
    {
      name: 'uid',
      type: 'int',
    },
    {
      name: 'name',
      type: 'string',
      minLength: 2
    }, 
    {
      name: 'email',
      type: 'string',
    },
    {
      name: 'password',
      type: 'string',
    },
    {
      name: 'phone',
      typ: 'string',
    },
    {
      name: 'avatar',
      type: 'string',
    },
    {
      name: 'created',
      type: 'string'
    },
    {
      name: 'lastlogin',
      type: 'string'
    }
  ],
  idProperty: "uid",
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
      create: "/user/add",
      update: "/user/update",
      read: "/user/get",
      destroy: "/user/delete"
    },
    listeners: {
      exception: function (proxy, response, options) {
        proxy.serverResponse = response;
      }
    }
  },
});