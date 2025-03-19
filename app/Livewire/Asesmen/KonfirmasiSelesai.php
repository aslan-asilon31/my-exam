<?php

namespace App\Livewire\Asesmen;

use Livewire\Component;

class KonfirmasiSelesai extends Component
{
    public string $title = 'Confirmation finish '; 

    public function render()
    {

        return view('livewire.asesmen.konfirmasi-selesai')
        ->layout('components.layouts.app_visitor')
        ->title($this->title);
    }
}
