jQuery(document).ready(function () {

    var FbHelper = new FacebookApiExtension();

    FbHelper.init();

    /** TEST DIDIER **/
    FbHelper.action.picture();
    FbHelper.action.like();
});