# Doorcam Notifier

## Getting Started

An automated photo logging and notification system that captures an image when the parking door opens and sends it to a Bale messenger channel, along with timestamped logs.

---


## Features

- 📸 Captures photo when parking door is triggered
- ⚙️ Robot management system
- 🚀 Automatically uploads image to FTP server
- 📤 Sends photo with timestamp to Bale messenger channel
- 🗂️ Saves logs locally with time and event details
- 🧩 Works with IP cameras or other triggerable devices

---

##  How It Works

1. Parking door opens (trigger event)
2. A connected camera captures a photo
3. The photo is uploaded to a server via FTP
4. A bot sends the photo + timestamp to a Bale channel
5. A local log file is updated with the event info

---

## Logs

The app creates a `log.txt` file where it stores:
- 📅 Timestamp of each captured photo
- ✅ FTP upload success/failure
- 💬 Bale message status

---

## Requirements
- IP or USB camera capable of auto-capturing on trigger
- FTP server access
- Bale bot token and chat ID
- Basic Python (or script-based) runtime environment

---

## Testing
- Simulate door opening using manual trigger
- Ensure image is captured and FTP upload works
- Confirm image + timestamp appears in Bale channel
- Check `log.txt` for detailed history

 Note: You can also use FileZilla if you don't have a camera.

---

## Demo


📎 [Execute](https://drive.google.com/drive/folders/1HjbV6S078ayRYL2unL7urI5lNrDyTqX8?usp=sharing)

---

## Documents

FTP Gallery Settings 📎 [View](https://docs.google.com/document/d/1tYmgI_Uj_THKlP67nGHZtF7_qWibIm5nDwBjojQCiws/edit?usp=sharing)


---
