/**
 * @license Copyright (c) 2003-2021, CKSource - Frederico Knabben. All rights reserved.
 * For licensing, see https://ckeditor.com/legal/ckeditor-oss-license
 */

CKEDITOR.editorConfig = function(config) {


    config.filebrowserBrowseUrl = "asset/admin/dist/ckfinder/ckfinder.html";
    config.filebrowserImageBrowseUrl = "asset/admin/dist/ckfinder/ckfinder.html?type=Images";
    config.filebrowserFlashBrowseUrl = "asset/admin/dist/ckfinder/ckfinder.html?type=Flash";
    config.filebrowserUploadUrl = "asset/admin/dist/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Files";
    config.filebrowserImageUploadUrl = "asset/admin/dist/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Images";
    config.filebrowserFlashUploadUrl = "asset/admin/dist/ckfinder/core/connector/aspx/connector.aspx?command=QuickUpload&type=Flash";

};