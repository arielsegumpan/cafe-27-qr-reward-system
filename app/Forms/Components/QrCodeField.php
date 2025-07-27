<?php

namespace App\Forms\Components;

use Filament\Forms\Components\Field;

class QrCodeField extends Field
{
    protected string $view = 'forms.components.qr-code-field';


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


    protected function setUp(): void
    {
        parent::setUp();

        $this->afterStateHydrated(function (QrCodeField $component, $state) {
            // When loading existing data
            if (is_array($state)) {
                $component->state($state);
            }
        });

        $this->dehydrateStateUsing(function ($state) {
            // Ensure we always store as array
            return is_array($state) ? $state : [];
        });
    }

    public function getQrCodeUrl(): string
    {
        $record = $this->getRecord();
        $state = $this->getState();

        // Use existing data if available
        if (!empty($state) && is_array($state)) {
            $qrData = $state;
        } else if ($record) {
            // Create new data if no state exists
            $qrData = [
                'cust_num' => $record->cust_num ?? '',
                'full_name' => $record->full_name ?? '',
                'email' => $record->email ?? $record->user?->email ?? '',
                'phone_number' => $record->phone_number ?? '',
                'created_at' => $record->created_at?->format('M. j, Y - g:ia') ?? '',
            ];

            // Save the generated data
            $this->state($qrData);
        } else {
            return '';
        }

        // Build query parameters for QR API
        $params = http_build_query([
            'size' => $this->size . 'x' . $this->size,
            'data' => json_encode($qrData),
            'format' => $this->format,
            'ecc' => $this->errorCorrectionLevel,
            'color' => $this->color,
            'bgcolor' => $this->backgroundColor,
        ]);

        return $this->qrApiUrl . '?' . $params;
    }
    // public function getQrCodeUrl(): string
    // {
    //     $record = $this->getRecord();

    //     if (!$record) {
    //         return '';
    //     }

    //     // Create the data to encode in QR code
    //     $qrData = json_encode([
    //         'cust_num' => $record->cust_num ?? '',
    //         'first_name' => $record->first_name ?? '',
    //         'last_name' => $record->last_name ?? '',
    //         'full_name' => $record->full_name ?? '',
    //         'email' => $record->email ?? $record->user?->email ?? '',
    //         'phone_number' => $record->phone_number ?? '',
    //         'created_at' => $record->created_at?->format('M. j, Y - g:ia') ?? '',
    //     ]);

    //     // Build query parameters for QR API
    //     $params = http_build_query([
    //         'size' => $this->size . 'x' . $this->size,
    //         'data' => $qrData,
    //         'format' => $this->format,
    //         'ecc' => $this->errorCorrectionLevel,
    //         'color' => $this->color,
    //         'bgcolor' => $this->backgroundColor,
    //     ]);

    //     return $this->qrApiUrl . '?' . $params;
    // }

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
