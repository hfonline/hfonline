Ext.define("Ext.ux.store.User", {
  extend: "Ext.data.Store",
  model: "Ext.ux.model.User",
  proxy: {
    type: "ajax",
    api: "user/list",
    reader: {
      type: "json",
      root: "data",
      totalProperty: "total"
    }
  }
});