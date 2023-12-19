<?php

interface IServiceAgency
{
    public function add(Agency $agency);
    public function update(Agency $agency);
    public function display();
    public function delete($agencyId);
}

?>