<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;
use Filament\Infolists\Components\Entry;

class QrCodeEntry extends Entry
{
    protected string $view = 'forms.components.qr-code-entry';

    protected string $qrApiUrl = 'https://api.qrserver.com/v1/create-qr-code/';
    protected int $size = 200;
    protected string $format = 'png';
    protected string $errorCorrectionLevel = 'L';
    protected string $color = '000000';
    protected string $backgroundColor = 'ffffff';

    public function size(int $size): static
    {
        $this->size = $size;
        return $this;
    }

    public function format(string $format): static
    {
        $this->format = $format;
        return $this;
    }

    public function errorCorrectionLevel(string $level): static
    {
        $this->errorCorrectionLevel = $level;
        return $this;
    }

    public function color(string $color): static
    {
        $this->color = ltrim($color, '#');
        return $this;
    }

    public function backgroundColor(string $backgroundColor): static
    {
        $this->backgroundColor = ltrim($backgroundColor, '#');
        return $this;
    }

    public function qrApiUrl(string $url): static
    {
        $this->qrApiUrl = $url;
        return $this;
    }

    public function getQrCodeUrl(): string
    {
        $record = $this->getRecord();

        if (!$record) {
            return '';
        }

        // Create the data to encode in QR code
        $qrData = json_encode([
            'cust_num' => $record->cust_num ?? '',
            'full_name' => $record->full_name ?? '',
            'email' => $record->email ?? $record->user?->email ?? '',
            'phone_number' => $record->phone_number ?? '',
            'created_at' => $record->created_at?->format('M. j, Y - g:ia') ?? '',
        ]);

        // Build query parameters for QR API
        $params = http_build_query([
            'size' => $this->size . 'x' . $this->size,
            'data' => $qrData,
            'format' => $this->format,
            'ecc' => $this->errorCorrectionLevel,
            'color' => $this->color,
            'bgcolor' => $this->backgroundColor,
        ]);

        return $this->qrApiUrl . '?' . $params;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getFormat(): string
    {
        return $this->format;
    }

    public function getErrorCorrectionLevel(): string
    {
        return $this->errorCorrectionLevel;
    }

    public function getColor(): string
    {
        return $this->color;
    }

    public function getBackgroundColor(): string
    {
        return $this->backgroundColor;
    }

    public function getQrData(): array
    {
        $record = $this->getRecord();

        if (!$record) {
            return [];
        }

        return [
            'cust_num' => $record->cust_num ?? '',
            'full_name' => $record->full_name ?? '',
            'email' => $record->email ?? $record->user?->email ?? '',
            'phone_number' => $record->phone_number ?? '',
            'created_at' => $record->created_at?->format('M. j, Y - g:ia') ?? '',
        ];
    }
}
