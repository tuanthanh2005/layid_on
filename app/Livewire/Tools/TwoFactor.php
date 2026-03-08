<?php

namespace App\Livewire\Tools;

use Livewire\Component;

class TwoFactor extends Component
{
    public $tokenInput = '';
    public $results = [];
    public $generatedCode = '------'; // Keep for backward compatibility if needed, or remove if not used elsewhere

    public function generate()
    {
        $this->validate([
            'tokenInput' => 'required'
        ]);

        $lines = explode("\n", str_replace("\r", "", $this->tokenInput));
        $this->results = [];

        foreach ($lines as $line) {
            $line = trim($line);
            if (empty($line)) continue;

            // Extract the potential secret part
            // Handles formats like: 
            // - ABCDE12345
            // - user|pass|ABCDE12345
            // - user|pass|ABCDE12345|junk
            $parts = explode('|', $line);
            $secret = '';
            
            // Heuristic: the secret is usually the longest part or specifically-sized
            // Let's assume for now it's often the last part if there are multiple, 
            // but we'll try to find a part that looks like a 2FA secret (alphanumeric, 16+ chars)
            foreach ($parts as $part) {
                $cleanPart = trim(str_replace(' ', '', $part));
                if (preg_match('/^[A-Z2-7]{16,32}$/i', $cleanPart)) {
                    $secret = $cleanPart;
                    break;
                }
            }

            // Fallback: if no 16-32 char A-Z2-7 string found, take the longest part
            if (empty($secret)) {
                $longest = '';
                foreach ($parts as $p) {
                    if (strlen(trim($p)) > strlen($longest)) $longest = trim($p);
                }
                $secret = $longest;
            }

            // Mock generation logic (in real app, use a Google2FA library)
            // For now, we simulate success for any "secret-looking" string
            if (strlen($secret) > 8) {
                $code = rand(100, 999) . ' ' . rand(100, 999);
                $this->results[] = [
                    'input' => $line,
                    'code' => $code
                ];
                $this->generatedCode = $code; // Set first/last for old view
            }
        }
    }

    public function render()
    {
        return view('livewire.tools.two-factor');
    }
}
