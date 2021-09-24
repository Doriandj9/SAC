<?php

namespace frame;

interface WebRoutes{
    public function getRoutes(): array;
    public function getAutentification(): \controllers\Autentification;
    public function getResponsability(): array;
}
