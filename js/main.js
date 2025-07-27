(function ($) {
    "use strict";

    // Spinner
    var spinner = function () {
        setTimeout(function () {
            if ($('#spinner').length > 0) {
                $('#spinner').removeClass('show');
            }
        }, 1);
    };
    spinner();
    
    
    // Initiate the wowjs
    new WOW().init();


    // Sticky Navbar
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.sticky-top').css('top', '0px');
        } else {
            $('.sticky-top').css('top', '-100px');
        }
    });
    
    
    // Dropdown on mouse hover
    const $dropdown = $(".dropdown");
    const $dropdownToggle = $(".dropdown-toggle");
    const $dropdownMenu = $(".dropdown-menu");
    const showClass = "show";
    
    $(window).on("load resize", function() {
        if (this.matchMedia("(min-width: 992px)").matches) {
            $dropdown.hover(
            function() {
                const $this = $(this);
                $this.addClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "true");
                $this.find($dropdownMenu).addClass(showClass);
            },
            function() {
                const $this = $(this);
                $this.removeClass(showClass);
                $this.find($dropdownToggle).attr("aria-expanded", "false");
                $this.find($dropdownMenu).removeClass(showClass);
            }
            );
        } else {
            $dropdown.off("mouseenter mouseleave");
        }
    });
    
    
    // Back to top button
    $(window).scroll(function () {
        if ($(this).scrollTop() > 300) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });


    // Header carousel
    $(".header-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1500,
        items: 1,
        dots: false,
        loop: true,
        nav : true,
        navText : [
            '<i class="bi bi-chevron-left"></i>',
            '<i class="bi bi-chevron-right"></i>'
        ]
    });


    // Testimonials carousel
    $(".testimonial-carousel").owlCarousel({
        autoplay: true,
        smartSpeed: 1000,
        center: true,
        margin: 24,
        dots: true,
        loop: true,
        nav : false,
        responsive: {
            0:{
                items:1
            },
            768:{
                items:2
            },
            992:{
                items:3
            }
        }
    });
    
})(jQuery);

// ChatBoat
const chatbotContainer = document.getElementById("chatbot-container");
const chatbotMessages = document.getElementById("chatbot-messages");
const chatInput = document.getElementById("chat-input");

function toggleChatbot() {
    chatbotContainer.style.display = chatbotContainer.style.display === "flex" ? "none" : "flex";
}

// Predefined chatbot responses
const responses = {
    "hi": "Hello! How can I assist you today?",
    "hello": "Hi there! Need help with something?",
    "how are you": "I'm just a chatbot, but I'm doing great! How about you?",
    "what is your name": "I'm your friendly chatbot!",
    "bye": "Goodbye! Have a great day!",
    "default": "I'm not sure how to respond to that. Try asking something else!"
};

function sendMessage() {
    const userMessage = chatInput.value.trim().toLowerCase();
    if (!userMessage) return;

    displayMessage(userMessage, "user");
    chatInput.value = "";

    setTimeout(() => {
        const botResponse = responses[userMessage] || responses["default"];
        displayMessage(botResponse, "bot");
    }, 500);
}

function handleKeyPress(event) {
    if (event.key === "Enter") {
        sendMessage();
    }
}

function displayMessage(message, sender) {
    const messageElement = document.createElement("div");
    messageElement.textContent = message;
    messageElement.classList.add(sender === "user" ? "user-message" : "bot-message");
    chatbotMessages.appendChild(messageElement);
    chatbotMessages.scrollTop = chatbotMessages.scrollHeight;
}
