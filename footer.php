<?php

if (isset($_GET['lang'])){
    $lang =$_GET['lang'];
}
else{
    $lang = 'en';
}

if ($lang === 'mm') {
    $isMM = true;
} else {
    $isMM = false;
}
?>


<footer class="bg-black border-t border-purple-900/30 backdrop-blur-md mt-20 py-12">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-8">

            <!-- Brand Column -->
            <div>
                <div class="flex items-center gap-3 mb-4">
                    <div class="w-10 h-10 rounded-lg bg-gradient-to-br from-purple-600 to-purple-900 flex items-center justify-center">
                        <i class="fas fa-shield-halved text-purple-200 text-lg"></i>
                    </div>
                    <div>
                        <div class="font-orbitron font-bold text-sm text-gradient">CYBER LAW</div>
                        <div class="text-xs text-purple-500">
                            <?php
                            if ($isMM) {
                                echo 'သတိပြုမှုစနစ်';
                            } else {
                                echo 'Awareness System';
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <p class="text-purple-400/70 text-sm leading-relaxed">
                    <?php
                    if ($isMM) {
                        echo 'မြန်မာနိုင်ငံ ဆိုက်ဘာဥပဒေများနှင့် ပတ်သက်သော သတင်းအချက်အလက်များကို ဒွိဘာသာစကားဖြင့် ပေးဆောင်သည့် ဝက်ဘ်ဆိုက်တစ်ခု။';
                    } else {
                        echo 'A bilingual platform providing information about Myanmar Cyber Laws to promote public awareness and digital safety.';
                    }
                    ?>
                </p>
            </div>

            <!-- Quick Links Column -->
            <div>
                <h3 class="font-orbitron font-semibold text-purple-300 text-sm mb-4 tracking-wider uppercase">
                    <?php
                    if ($isMM) {
                        echo 'လင့်ခ်များ';
                    } else {
                        echo 'Quick Links';
                    }
                    ?>
                </h3>
                <ul class="space-y-2">
                    <li>
                        <a href="index.php" class="text-purple-400/70 hover:text-purple-300 text-sm transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            <?php
                            if ($isMM) {
                                echo 'ပင်မစာမျက်နှာ';
                            } else {
                                echo 'Home';
                            }
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="/index.php#laws" class="text-purple-400/70 hover:text-purple-300 text-sm transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            <?php
                            if ($isMM) {
                                echo 'ဆိုက်ဘာဥပဒေများ';
                            } else {
                                echo 'Cyber Laws';
                            }
                            ?>
                        </a>
                    </li>
                    <li>
                        <a href="/search.php" class="text-purple-400/70 hover:text-purple-300 text-sm transition-colors">
                            <i class="fas fa-chevron-right text-xs mr-2"></i>
                            <?php
                            if ($isMM) {
                                echo 'ရှာဖွေရန်';
                            } else {
                                echo 'Search Laws';
                            }
                            ?>
                        </a>
                    </li>
                </ul>
            </div>

            <!-- Notice Column -->
            <div>
                <h3 class="font-orbitron font-semibold text-purple-300 text-sm mb-4 tracking-wider uppercase">
                    <?php
                    if ($isMM) {
                        echo 'အကြောင်းကြားချက်';
                    } else {
                        echo 'Notice';
                    }
                    ?>
                </h3>
                <p class="text-purple-400/70 text-sm leading-relaxed">
                    <?php
                    if ($isMM) {
                        echo 'ဤဝက်ဘ်ဆိုက်ရှိ အချက်အလက်များသည် ပညာပေးရည်ရွယ်ချက်ဖြင့်သာ ဖြစ်ပြီး တရားရေးဆိုင်ရာ အကြံဉာဏ်ပေးခြင်း မဟုတ်ပါ။';
                    } else {
                        echo 'The information on this website is for educational purposes only and does not constitute legal advice. Always consult a qualified legal professional.';
                    }
                    ?>
                </p>
            </div>

        </div><

        
        <div class="border-t border-purple-900/40 pt-6 flex flex-col sm:flex-row justify-between items-center gap-4">
            <p class="text-purple-500/60 text-xs">
                
                &copy; <?php echo date('Y'); ?> Cyber Law Awareness System.
                <?php
                if ($isMM) {
                    echo 'မူပိုင်ခွင့် အာမခံ.';
                } else {
                    echo 'All rights reserved.';
                }
                ?>
            </p>
            <div class="flex items-center gap-1 text-purple-500/60 text-xs">
                <i class="fas fa-shield-halved text-purple-600"></i>
                <span>
                    <?php
                    if ($isMM) {
                        echo 'ဒစ်ဂျစ်တယ် ဘေးကင်းရေး';
                    } else {
                        echo 'Promoting Digital Safety';
                    }
                    ?>
                </span>
            </div>
        </div>

    </div>
</footer>