<?php

namespace App\Livewire\Pages;

use Livewire\Component;
use Livewire\Attributes\Layout;

class MenuDashboard extends Component
{
    #[Layout('layouts.auth-app')]
    public function render()
    {
        return view('livewire.pages.menu-dashboard');
    }
}
