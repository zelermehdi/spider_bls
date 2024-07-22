const puppeteer = require('puppeteer');

(async () => {
    try {
        const email = process.argv[2];
        const password = process.argv[3];

        if (!email || !password) {
            throw new Error('Email and password must be provided.');
        }

        console.log(`Email: ${email}`);
        console.log(`Password: ${password}`);

        const browser = await puppeteer.launch({
            headless: true,
            args: ['--no-sandbox', '--disable-setuid-sandbox']
        });
        console.log('Browser launched.');

        const page = await browser.newPage();
        await page.goto('https://algeria.blsspainvisa.com/french/');
        console.log('Page loaded.');

        // Connexion
        await page.waitForSelector('#Email');
        console.log('Email selector found.');
        await page.type('#Email', email);
        await page.type('#Password', password);
        await page.click('#btnLogin');
        await page.waitForNavigation();
        console.log('Logged in.');

        // Sélection des options de rendez-vous (remplacer par les valeurs correctes)
        await page.select('#VisaCategoryId', '1'); // Remplacer par la valeur correcte
        await page.select('#VisaTypeId', '1'); // Remplacer par la valeur correcte
        await page.select('#VisaSubTypeId', '1'); // Remplacer par la valeur correcte
        await page.select('#AppointmentFor', '1'); // Remplacer par la valeur correcte
        console.log('Appointment options selected.');

        // Soumettre le formulaire de rendez-vous
        await page.click('#btnContinue');
        await page.waitForNavigation();
        console.log('Appointment booked.');

        await browser.close();
    } catch (error) {
        console.error('Error:', error);
    }
})();
