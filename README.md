# Password Locked Threads
This is a basic addition to vichan, that allows for the addition of Password Locked Threads (PLT).
## How it works:
These PLT work by encrypting the message content of any thread.
Users input an optional encryption password *(No pass = normal thread)*, when inputted, the thread will be encrypted and saved into a json database. 
*(It is required that you should 403 lock these, being "active.json" and "thread.json").*
Upon the creation of the encrypted thread, it will look unreadable and random. When users open up the thread, they must input the encryption key.
If correct, a message will say so, and from then on, all messages in the thread will be automatically encrypted and decrypted.
If for some reason there is an error with the encryption key, the user can click "reset" and be reset to an unencrypted connection.
## Moderation of PLT:
For your moderators, they will access a 2nd "mod.php". This moderation portal will have one common User and Password that all your mods / janitors / admins will use.
Upon inputting their credentials, they will be given a list of ALL encrypted threads passwords, and the related thread link.
## How to add to your vichan instance:
1. Download all files in this repo, add it to a folder called "crypt".
2. Edit your BASE PASSWORD in the "crypt.php" file.
3. Edit your MOD CREDENTIALS in the "mod.php" file.
4. Add this script tag to your desired board: **<script src = '/crypt/client.js'></script>**
5. Tell your mods how to access encrypted threads.
Now you are done! You now have PLT.
