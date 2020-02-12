<?php

cb()->routeGroupBackend(function () {
    cb()->routePost("select-table-lookup",'\ersaazis\cb\types\select_table\SelectTableController@postLookup');
});