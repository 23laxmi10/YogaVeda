<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chatbot</title>
    <style>
      /* Basic styling for chatbot */
      #chatbot-container {
          position: fixed;
          bottom: 20px;
          right: 20px;
          width: 300px;
          border: 1px solid #ccc;
          border-radius: 10px;
          box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
          background-color: #fff;
      }

      #chatbot-header {
          padding: 10px;
          background-color: #007bff;
          color: white;
          border-top-left-radius: 10px;
          border-top-right-radius: 10px;
          display: flex;
          justify-content: space-between;
          align-items: center;
      }

      #chatbot-messages {
          padding: 10px;
          height: 200px;
          overflow-y: auto;
      }

      #chatbot-input {
          padding: 10px;
          display: flex;
      }

      #chatbot-input input {
          flex: 1;
          padding: 10px;
          border: 1px solid #ccc;
          border-radius: 5px;
      }

      #chatbot-input button {
          margin-left: 5px;
          padding: 10px;
          background-color: #007bff;
          color: white;
          border: none;
          border-radius: 5px;
      }

      .user-message {
          text-align: right;
          margin-bottom: 10px;
          color: blue;
      }

      .bot-message {
          text-align: left;
          margin-bottom: 10px;
          color: green;
      }
    </style>
</head>
<body>

<!-- Chatbot Box -->
<div id="chatbot-container">
    <div id="chatbot-header">
        <span>Chat with us</span>
        <button onclick="closeChatbot()">✖</button>
    </div>
    <div id="chatbot-messages" style="height: 200px; overflow-y: scroll;"></div> <!-- Message container -->
    <div id="chatbot-input">
        <input type="text" id="chat-input" placeholder="Type a message..." onkeypress="handleKeyPress(event)"> <!-- Handle keypress event -->
        <button onclick="sendMessage()">Send</button>
    </div>
</div>

<script>
// Predefined chatbot responses
const responses = {
    "hi": "Hello! How can I assist you today?",
    "hello": "Hi there! Need help with something?",
    "how are you": "I'm just a chatbot, but I'm doing great! How about you?",
    "what is your name": "I'm your friendly chatbot!",
    "bye": "Goodbye! Have a great day!",
      "what is yoga": "Yoga is a practice that combines postures, breathing, and meditation for a healthy body and mind.",
    "benefits of yoga": "Yoga improves flexibility, reduces stress, boosts strength, and enhances mental clarity.",
    "types of yoga": "Popular types include Hatha, Vinyasa, Ashtanga, Bikram, and Kundalini yoga.",
    "who can do yoga": "Anyone can do yoga, regardless of age, fitness level, or experience.",
    "best time for yoga": "Early morning or evening are ideal times for yoga practice.",
    "what is pranayama": "Pranayama is the practice of breath control in yoga to enhance energy and focus.",
    "is yoga a religion": "No, yoga is a spiritual and physical discipline, not a religion.",
    "how often should I do yoga": "Practicing yoga 3–5 times a week can bring great benefits.",
    "do I need equipment for yoga": "All you need is a yoga mat and comfortable clothing to start.",
    "can yoga help with anxiety": "Yes, yoga helps calm the mind and reduce anxiety through breathing and meditation.",
    "yoga": "Yoga is an ancient Indian practice that combines physical postures, breathing techniques, and meditation to improve overall well-being. It helps increase flexibility, reduce stress, and bring balance to the mind and body.",
    "default": "I'm not sure how to respond to that. Try asking something else!"
};

// Function to send a message
function sendMessage() {
    const chatInput = document.getElementById("chat-input");
    const userMessage = chatInput.value.trim().toLowerCase();
    if (!userMessage) return;  // Do nothing if message is empty

    displayMessage(userMessage, "user");  // Display user's message
    chatInput.value = "";  // Clear input field

    // Display bot response after a short delay
    setTimeout(() => {
        const botResponse = responses[userMessage] || responses["default"];
        displayMessage(botResponse, "bot");
    }, 500);
}

// Function to handle Enter key press
function handleKeyPress(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
}

// Function to display a message in the chat
function displayMessage(message, sender) {
    const chatbotMessages = document.getElementById("chatbot-messages");
    const messageElement = document.createElement("div");
    messageElement.textContent = message;
    messageElement.classList.add(sender === "user" ? "user-message" : "bot-message");
    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;  // Auto-scroll to the latest message
}

// Close chatbot
function closeChatbot() {
    window.location.href = "index.html";  // Redirect to home or another page when closed
}
</script>

</body>
</html>
