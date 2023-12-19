<?php

    interface IRoleService {
        function create(Role $role);
        function delete($id);
    }

?>