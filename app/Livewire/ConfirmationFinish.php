<?php

namespace App\Livewire;

use Livewire\Component;

class ConfirmationFinish extends Component
{
    public string $title = 'Confirmation finish '; 

    public function render()
    {

        return view('livewire.confirmation-finish')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
