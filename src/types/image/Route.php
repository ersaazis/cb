<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("upload-image",'\ersaazis\cb\types\image\ImageController@postUploadImage');
});

cb()->routeGroupDeveloper(function () {
    cb()->routePost("upload-image",'\ersaazis\cb\types\image\ImageController@postUploadImage');
});
