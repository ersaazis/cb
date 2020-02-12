<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("upload-file",'\Ersaazis\CB\types\file\FileController@postUploadFile');
});

cb()->routeGroupDeveloper(function () {
    cb()->routePost("upload-file",'\Ersaazis\CB\types\file\FileController@postUploadFile');
});