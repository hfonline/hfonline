Ext.define("Ext.ux.store.Food", {
  model: "Ext.ux.model.Food",
  extend: "Ext.data.Store",
  proxy: {
    type: 'ajax',
    reader: {
      type: 'json',
      root: "data",
    },
    writer: {
      type: "ajax",
      writeAllFields: true,
    },
    api: {
      create: "/food/add",
      update: "/food/update",
      read: "/food/get",
      destroy: "/food/delete"
    }
  },
});