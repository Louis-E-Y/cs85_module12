Reflection: 
    1. The AI output changed accordingly with what it is instructed to respond like, a professional response about dinosaurs reads like an actual scientific paper:"# Dinosaurs: Unearthing the Wonders of Earth’s Prehistoric Past. For centuries, few subjects have captured the human imagination..." while a humorous or casual one reads exactly like what it sounds like. 
    2. The prompt changed across content types because each type, regardless of tone, has vastly differing requirements. A meta description or email subject line need something short and attention grabbing, while a blog post should be of substance and well structured and keep it professional to a degree regardless of tone.
    3. The API integration for a production app I would change it so users can switch models, input custom response types and tones, and I would make it so there is some info given back about the status of their request and the response incoming. Maybe a section that can give the user hints about how to improve their own prompting, or autocomplete, or suggestions for related topics.


Setup (WINDOWS): 
    0. Open terminal to your files directory.
    1.Obtain an API key for free at aistudio.google.com
    2. Setup .env with: 
        GEMINI_API_KEY=YOURACTUALAPIKEY
        GEMINI_API_URL=https://generativelanguage.googleapis.com/v1beta
        GEMINI_MODEL=gemini-flash-latest
    3. Make sure Laravel Herd is running
    (4.) Alternatively run the built in server with php artisan serve in a terminal on your file directory.
    5. Visit http://blog-ai.test/ai-form (or http://localhost:8000/ai-form if you used php artisan serve).
    6. Use freely to generate desired content type about desired topic in desired tone.