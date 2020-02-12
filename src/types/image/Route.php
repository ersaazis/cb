<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("upload-image",'\Ersaazis\CB\types\image\ImageController@postUploadImage');
});

cb()->routeGroupDeveloper(function () {
    cb()->routePost("upload-image",'\Ersaazis\CB\types\image\ImageController@postUploadImage');
});
