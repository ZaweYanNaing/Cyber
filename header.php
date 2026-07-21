<?php

if (isset($_GET['lang'])){
    $lang =$_GET['lang'];
}
else{
    $lang = 'en';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" integrity="sha512-Avb2QiuDEEvB4bZJYdft2mNjVShBftLdPG8FJ0V7irTLQ8Uo0qcPxh4Plq7G5tGm0rU+1SPhVotteLpBERwTkw==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    
    
  


</head>
<body>
    <header>
     <nav class="bg-black text-pink-300">
        <div class="max-w-7xl flex justify-between items-center mx-auto py-2">
            <div class="flex gap-2 items-center logo">
                <div class="flex items-center text-white bg-purple-700 px-2 py-1 rounded-md size-10 justify-center"> 
                    <i class="fa-solid fa-shield-halved"></i>
                </div>
                <div>
                    <h1>CYBER LAW</h1>
                    <p>Awreness System</p>
                </div>
            </div>
            <div class="links hidden md:flex items-center gap-8">
                
                <a href="index.php" class="nav-link text-[#9d7fc5] hover:text-[#c084fc] text-sm tracking-wide ">
                   <?php echo $lang=='en'? 'Home' : 'ပင်မစာမျက်နှာ' ?>
                </a>
                <a href="index.php#laws" class="nav-link text-[#9d7fc5] hover:text-[#c084fc] text-sm tracking-wide">
                    <?php echo $lang=='en'? 'Laws' : 'ဥပဒေများ' ?>
                </a>
                <a href="search.php" class="nav-link text-[#9d7fc5] hover:text-[#c084fc] text-sm tracking-wide ">
                    <?php echo $lang=='en'? 'Search' : 'ရှာဖွေမှု' ?>
                </a>
           
            </div>
            <div class="button">
                <div class="flex bg-[rgba(20,0,50,0.8)] border border-purple-900/30 rounded-lg overflow-hidden">
                    <a href="?lang=en" class="px-4 py-1.5 text-xs font-semibold transition-all duration-300 cursor-pointer no-underline <?php echo $lang=='en'? 'bg-[#7c3aed] text-white' : 'text-[#9d7fc5]' ?>">EN</a>
                    <a href="?lang=mm" class="px-4 py-1.5 text-xs font-semibold transition-all duration-300 cursor-pointer no-underline <?php echo $lang=='mm'? 'bg-[#7c3aed] text-white' : 'text-[#9d7fc5]' ?>">မြန်မာ</a>
                </div>
                
            </div>
        </div>


     </nav>

    </header>

  
</body>
</html>