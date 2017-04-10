# Project 10 - Honeypot

Time spent: 3 hours spent in total

> Objective: Setup a honeypot and provide a working demonstration of its features.

### Required: Overview & Setup

- [X] A basic writeup (250-500 words) on the `README.md` desribing the overall approach, resources/tools used, findings
		The Honeypot that I used is a Shockpot Honeypot, available on Modern Honey Network. The instructions on how to install MHN are available at the following link: https://github.com/threatstream/mhn/wiki/Getting-up-and-running-using-Vagrant and require Vagrant and VirtualBox. Provided that you have installed all of those services, head to the "Deploy" tab and from the drop down select "Ubuntu - Shockpot". Copy the deploy command to your clipboard and ssh into your vagrant honeypot using "vagrant ssh honeypot". From here "sudo su -" to log in as root and run the command that you copied earlier and the Shockpot sensor should be installed. 
- [X] A specific, reproducible honeypot setup, ideally automated.

### Required: Demonstration

- [X] A basic writeup of the attack (what offensive tools were used, what specifically was detected by the honeypot)
		The attack requires that you have curl installed on your machine. Then run the following from your terminal: 'curl -H "User-Agent: () { :; }; /bin/ping -c 1 10.254.254.101" 10.25 4.254.101'. The IP used here should be correct provided that you followed the installation instructions correctly, however if they fail you can determine the proper IP using the "ifconfig" command in your honeypot. Information regarding the attack will be available on the "Attacks" tab of MHN.
- [X] An example of the data captured by the honeypot (example: IDS logs including IP, request paths, alerts triggered)
		img:
- [X] A screen-cap of the attack being conducted
    img:
    
### Optional: Features
- Honeypot
	- [ ] HTTPS enabled (self-signed SSL cert)
	- [ ] A web application with both authenticated and unauthenticated footprint
	- [ ] Database back-end
	- [ ] Custom exploits (example: intentionally added SQLI vulnerabilities)
	- [ ] Custom traps (example: modified version of known vulnerability to prevent full exploitation)
	- [ ] Custom IDS alert (example: email sent when footprinting detected)
	- [ ] Custom incident response (example: IDS alert triggers added firewall rule to block an IP)
- Demonstration
	- [ ] Additional attack demos/writeups
	- [ ] Captured malicious payload
	- [ ] Enhanced logging of exploit post-exploit activity (example: attacker-initiated commands captured and logged)
