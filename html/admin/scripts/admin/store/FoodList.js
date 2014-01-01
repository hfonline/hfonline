Ext.define('Ext.ux.store.FoodList', {
  extend: "Ext.data.Store",
  model: "Ext.ux.model.Food",
  storeId: "foodliststoreId",
  proxy: {
    type: "ajax",
    url: "/food/get",
    reader: {
      type: "json",
      root: "data",
      totalProperty: 'total',
    },
  },
  sorts: [
    "price", "star"
  ],
  pageSize: 10,
});