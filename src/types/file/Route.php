<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("upload-file",'\ersaazis\cb\types\file\FileController@postUploadFile');
});

cb()->routeGroupDeveloper(function () {
    cb()->routePost("upload-file",'\ersaazis\cb\types\file\FileController@postUploadFile');
});