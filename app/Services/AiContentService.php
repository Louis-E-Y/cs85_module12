<?php 

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class AiContentService
{
    public function generateDraft(string $title, string $type = 'blog post', string $tone = 'professional'): string
    {
        $prompt = $this->buildPrompt($title, $type, $tone);

        $response = Http::withHeaders([
        'x-goog-api-key' => config('services.gemini.key'),
        'Content-Type'   => 'application/json',
        ])->post(config('services.gemini.url') . '/models/' . config('services.gemini.model') . ':generateContent', [
        'systemInstruction' => [
            'parts' => [['text' => 'You are an AI writing assistant.']],
        ],
        'contents' => [
            ['parts' => [['text' => $prompt]]],
        ],
        'generationConfig' => [
            'temperature'     => 0.7,
            'maxOutputTokens' => 2000, // increase as needed
        ],
    ]);

        if ($response->failed()) {
            Log::error('AI request failed: ' . $response->status() . ' - ' . $response->body());
            throw new \Exception('AI request failed');
        }

        $text = $response['candidates'][0]['content']['parts'][0]['text'] ?? 'No output received';
        return $text;
    }

        private function buildPrompt(string $title, string $type, string $tone): string
    {
        switch ($tone) {
            case 'professional':
                $role = "You are a professional writer who creates clear, polished content.";
                break;

            case 'casual':
                $role = "You are a casual writer who creates friendly and conversational content.";
                break;

            case 'humorous':
                $role = "You are a witty copywriter who uses humor and personality.";
                break;

            default:
                $role = "You are a helpful content writer.";
        }

        switch ($type) {
            case 'blog post':
                return "$role

        Write a blog post titled: \"$title\".

        Requirements:
        - Write a complete blog post.
        - Include an introduction, several body paragraphs, and a conclusion.
        - Use a $tone tone.
        - Aim for approximately 800-1000 words.";

                case 'meta description':
                    return "$role

        Create a meta description for: \"$title\".

        Requirements:
        - Write exactly one meta description.
        - Keep it around 155 characters.
        - Make it engaging and optimized for search engines.
        - Use a $tone tone.";

                case 'email subject line':
                    return "$role   

        Create an email subject line for: \"$title\".

        Requirements:
        - Write one short subject line.
        - Keep it concise and attention-grabbing.
        - Use a $tone tone.";

                default:
                    return "$role

        Create content about \"$title\" using a $tone tone.";
            }
        }
}