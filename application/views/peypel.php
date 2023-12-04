<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="<?=base_url()?>assets/styles/peypel.css"/>

    <title>Peypel (not scam)</title>
</head>
<body>
    <header>
        <h1>Peypel.com</h1>
    </header>

    <main class="loading-main">
        <h2 id="info">Totally legit payment API is loading...</h2>
        <div class="balls">
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
            <div id="ball"></div>
        </div>

        <script src="<?=base_url()?>assets/js/script.js"></script>
        <script>
            let i = 0;
            for (const child of document.querySelector('.balls').children) {
                setTimeout(() => {
                    // child.classList.remove("ball-bounce");
                    // window.requestAnimationFrame(() => {
                    //     child.classList.add("ball-bounce");
                    // });
                    child.classList.add("ball-bounce");
                }, 100 * i);

                i++;
            }

            setTimeout(() => {
                document.getElementById("info").textContent = "Money has been taken. Now redirecting...";
            }, 5000);

            setTimeout(() => {
                window.location = base_url+"index.php/book/success";
            }, 7000);
        </script>
    </main>
</body>
</html>