var d = new Date();
var h = d.getHours();
if (h < 11) { document.write('Selamat Pagi...'); }
else { if (h < 15) { document.write('Selamat Siang .....'); }
else { if (h < 19) { document.write('Selamat Sore .....'); }
else { if (h <= 23) { document.write('Selamat Malam .....'); }
}}}