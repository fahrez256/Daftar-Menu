# Daftar Menu - Telegram Bot Integration

## 📜 Overview
"Daftar Menu" is a project aimed at simplifying the ordering process in restaurants with multiple floors. This solution integrates a simple, yet effective, web interface with a Telegram Bot API to send orders directly to the cashier, allowing customers to order from anywhere in the restaurant without the need to physically go to the cashier.

## 🌟 Features
- **Menu Selection**: Customers can browse and select items from the restaurant's menu on a user-friendly website.
- **Real-Time Order Processing**: Orders are sent directly to the cashier via the Telegram Bot API, ensuring prompt preparation.
- **Barcode Access**: Customers can easily access the menu by scanning a barcode placed at their table.
- **Simple and Efficient**: Uses straightforward technologies to provide a reliable service with minimal overhead.

## 💻 Technologies Used
- **Frontend**: 
  - HTML & CSS for creating a responsive and simple user interface.
- **Backend**:
  - PHP & JavaScript for handling backend logic and order processing.
- **API**:
  - Telegram Bot API utilizing GET & POST methods for real-time order transmission.
- **Utilities**:
  - Barcode technology to facilitate easy access to the menu.

## 🚀 Installation
To run this project locally, follow these steps:

1. **Clone the repository (if applicable):**
```
git clone https://github.com/fahrez256/Daftar-Menu.git
cd daftar-menu
```

3. **Set up the backend:**
   - Ensure you have a PHP server running (e.g., XAMPP, MAMP).
   - Place the project files in the server's root directory.

4. **Configure Telegram Bot:**
   - Create a new bot on Telegram using the BotFather.
   - Get your API token and replace it in the project's configuration file.

5. **Start the server:**
   - Navigate to the project URL in your browser.

## 🔍 Usage
1. **Accessing the Menu**:
   - Scan the QR code on the table using your phone to open the menu in your browser.
   
2. **Placing an Order**:
   - Browse the menu and select items you wish to order.
   - Submit your order, which will be sent to the cashier via the Telegram Bot.

## ⚠️ Limitations
- **No CRUD Functionality**: The project lacks a CRUD (Create, Read, Update, Delete) interface for managing the menu items. All menu updates must be done manually in the code, which can be cumbersome and error-prone.
- **Manual Configuration**: Adjustments to the menu or bot settings require manual changes in the configuration files, which may not be user-friendly for non-technical users.
- **Experimental Nature**: This project was developed as a proof-of-concept to explore the use of the Telegram Bot API and may not include all features expected in a full-fledged menu management system.

## 📞 Contact
For more information, feel free to reach out:

- **Name**: Fahreza Raditya Busan
- **Email**: fahreza.raditya.busan@gmail.com
- **GitHub**: https://github.com/fahrez256
