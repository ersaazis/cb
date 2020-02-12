<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("select-table-lookup",'\Ersaazis\CB\types\select_table\SelectTableController@postLookup');
});