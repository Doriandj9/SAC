<?php

namespace frame;

interface WebRoutes{
    public function getRoutes(): array;
    public function getAutentification(): \controllers\Autentification;
    public function hashPermission($permission): bool;
    public function hashResponsability($responsability): bool;
}
