<?php

namespace App\Mail;

use App\Models\Pengaduan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class PengaduanMail extends Mailable
{
    use Queueable, SerializesModels;

    public $pengaduan;

    /**
     * Create a new message instance.
     */
    public function __construct(Pengaduan $pengaduan)
    {
        $this->pengaduan = $pengaduan;
    }

    /**
     * Build the message.
     */
    public function build()
    {
        return $this
            ->subject('Pengaduan Baru dari '.$this->pengaduan->name)
            ->markdown('emails.pengaduan')
            ->with([
                'name'    => $this->pengaduan->name,
                'number'  => $this->pengaduan->number,
                'content' => $this->pengaduan->content,
                'fileUrl' => $this->pengaduan->bukti_pengaduan
                    ? url($this->pengaduan->bukti_pengaduan)
                    : null,
                'created_at' => $this->pengaduan->created_at->format('d-m-Y'), // ← ini ditambahkan
            ]);
    }
}
