<?php

namespace App\Livewire;

use Livewire\Component;

class ChatSupport extends Component
{
    public $message;
    public $messages = [];

    public function sendMessage()
    {
        if (!$this->message) return;

        // Add the user's message to the chat
        $this->messages[] = ['sender' => 'user', 'text' => $this->message];

        // Simulate bot response (simple logic)
        $this->simulateBotReply($this->message);

        // Clear input after sending
        $this->message = '';
    }

    private function simulateBotReply($userMessage)
    {
        // Predefined responses (You can expand this logic)
        $botReplies = [
            'hi' => 'Hello! How can I assist you today?',
            'hello' => 'Hi there! Need any help?',
            'help' => 'Sure! What do you need help with?',
            'bye' => 'Goodbye! Have a great day!',
            'pila kada' => 'hindi ko carl!',
            'ngaa' => 'hindi ko gani carl!',
        ];

        $botReply = $botReplies[strtolower($userMessage)] ?? "I'm just a simple bot! 😊";

        // Add bot reply to chat
        $this->messages[] = ['sender' => 'bot', 'text' => $botReply];
    }

    public function render()
    {
        return view('livewire.chat-support');
    }
}
