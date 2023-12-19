<?php

interface IServiceAtm
{
    public function add(Atm $atm);
    public function update(Atm $atm);
    public function display();
    public function delete($atmId);
}

?>