Ext.define("Ext.ux.store.User", {
  extend: "Ext.data.Store",
  model: "Ext.ux.model.User",
  storeId: "userstoreid",
  proxy: {
    type: "ajax",
    url: "/user/list",
    reader: {
      type: "json",
      root: "data",
      totalProperty: "total"
    }
  }
});