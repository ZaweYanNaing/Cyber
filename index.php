<?php
require_once 'database.php';
require_once 'header.php';


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


$lawsQuery  = $conn->query("SELECT * FROM cyber_laws ");
$laws       = $lawsQuery->fetch_all(MYSQLI_ASSOC);






$lawCountQuery = $conn->query("SELECT COUNT(*) as total FROM cyber_laws ");
$lawCountRow   = $lawCountQuery->fetch_assoc();
$statsLaws     = $lawCountRow['total']; 

$crimeCountQuery = $conn->query("SELECT COUNT(*) as total FROM crimes");
$crimeCountRow   = $crimeCountQuery->fetch_assoc();
$statsCrimes     = $crimeCountRow['total']; 


$mediaCountQuery = $conn->query("SELECT COUNT(*) as total FROM media");
$mediaCountRow   = $mediaCountQuery->fetch_assoc();
$statsMedia      = $mediaCountRow['total']; 




$categoriesQuery = $conn->query("SELECT DISTINCT category FROM cyber_laws WHERE is_active = 1 ORDER BY category");
$categories      = $categoriesQuery->fetch_all(MYSQLI_ASSOC);




$catIcons = array(
    'Cybercrime'       => 'fa-bug',
    'Digital Commerce' => 'fa-shopping-cart',
    'Telecommunications' => 'fa-satellite-dish',
    'Privacy'          => 'fa-user-shield',
    'General'          => 'fa-scale-balanced',
);



if ($isMM) {
    $pageTitle = 'ပင်မစာမျက်နှာ'; 
} else {
    $pageTitle = 'Home';
}

$pageDesc = 'Explore Myanmar Cyber Laws in English and Burmese — Cyber Law Awareness System';



?>




<section class="relative overflow-hidden min-h-[85vh] flex items-center bg-black">
    <div class="hero-grid-bg"></div>

    
    <div class="absolute rounded-full [filter:blur(80px)] animate-[orb-float_8s_ease-in-out_infinite]"
         style="width:400px;height:400px;background:radial-gradient(circle,rgba(124,58,237,0.3),transparent);top:-100px;right:-50px"></div>
    <div class="absolute rounded-full [filter:blur(80px)] animate-[orb-float_8s_ease-in-out_infinite] [animation-delay:3s]"
         style="width:300px;height:300px;background:radial-gradient(circle,rgba(34,211,238,0.15),transparent);bottom:-50px;left:-50px"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 w-full py-16">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

            <!-- Hero Text Column -->
            <div>
                <!-- Small badge above the headline -->
                <div class="inline-flex items-center gap-1 px-3 py-1 rounded-full text-xs font-semibold tracking-wide
                            bg-purple-600/20 border border-purple-600/40 text-[#c084fc] mb-6">
                    <i class="fas fa-shield-halved text-xs"></i>
                    <?php
                    // Show Burmese or English badge text
                    if ($isMM) {
                        echo 'ဆိုက်ဘာဘေးကင်းရေး';
                    } else {
                        echo 'Digital Law Awareness';
                    }
                    ?>
                </div>

                <!-- Main headline -->
                <h1 class="font-orbitron font-black leading-tight mb-6" style="font-size:clamp(2rem,5vw,3.25rem)">
                    <?php
                    if ($isMM) {
                        
                        echo '<span class="text-white">ဆိုက်ဘာ</span> <span class="text-[#9d7fc5]">ဥပဒေ</span>'
                           . '<br>'
                           . '<span class="text-white">သတိပြုမှု</span> <span class="text-[#9d7fc5]">စနစ်</span>';
                    } else {
                        
                        echo '<span class="text-white">Cyber</span> <span class="text-[#9d7fc5]">Law</span>'
                           . '<br>'
                           . '<span class="text-white">Awareness</span> <span class="text-[#9d7fc5]">System</span>';
                    }
                    ?>
                </h1>

                <!-- Sub-headline paragraph -->
                <?php
               
                if ($isMM) {
                    $myanmarClass = 'font-myanmar';
                } else {
                    $myanmarClass = '';
                }
                ?>
                <p class="text-purple-300/70 text-lg leading-relaxed mb-8 max-w-lg <?php echo $myanmarClass; ?>">
                    <?php
                    if ($isMM) {
                        echo 'မြန်မာနိုင်ငံ ဆိုက်ဘာဥပဒေများကို ရှာဖွေကြည့်ရှုပြီး ဒစ်ဂျစ်တယ် ကျူးလွန်မှုများနှင့် ပြစ်ဒဏ်များကို နားလည်ပါ။';
                    } else {
                        echo 'Explore Myanmar Cyber Laws, understand digital crimes and their penalties. Available in English and Burmese.';
                    }
                    ?>
                </p>

                <!-- Live Search Bar -->
                <div class="relative mb-6">
                    
                  
                    <!-- Suggestions dropdown — filled by JavaScript below -->
                    <div id="search-suggestions"
                         class="absolute top-full left-0 right-0 mt-1
                                bg-[rgba(20,0,50,0.7)] border border-purple-900/30 rounded-2xl
                                backdrop-blur-xl hidden z-50 max-h-64 overflow-y-auto"></div>
                </div>

                <!-- CTA Buttons -->
                <div class="flex flex-wrap gap-3">
                    <!-- "Browse Laws" button — scrolls down to the law cards section -->
                    <a href="#laws"
                       class="btn-glow inline-flex items-center gap-2 bg-gradient-to-br from-[#7c3aed] to-[#a855f7]
                              text-white font-semibold tracking-wide px-7 py-3 rounded-lg text-sm
                              shadow-glow-sm hover:shadow-glow-md hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-scale-balanced"></i>
                        <?php
                        if ($isMM) {
                            echo 'ဥပဒေများ ကြည့်ရှုရန်';
                        } else {
                            echo 'Browse Laws';
                        }
                        ?>
                    </a>

                    
                    <?php
                   
                    if ($isMM) {
                        $searchLink = 'search.php?lang=mm';
                    } else {
                        $searchLink = 'search.php';
                    }
                    ?>
                    <a href="<?php echo $searchLink; ?>"
                       class="inline-flex items-center gap-2 bg-transparent text-[#c084fc]
                              border border-purple-900/30 font-semibold tracking-wide px-7 py-3 rounded-lg text-sm
                              hover:bg-purple-600/15 hover:border-[#7c3aed] hover:shadow-glow-sm hover:-translate-y-0.5 transition-all duration-300">
                        <i class="fas fa-search"></i>
                        <?php
                        if ($isMM) {
                            echo 'အဆင့်မြင့် ရှာဖွေမှု';
                        } else {
                            echo 'Advanced Search';
                        }
                        ?>
                    </a>
                </div>
            </div>

            
            <div class="hidden lg:flex justify-center items-center relative">
                <div class="relative w-80 h-80">
                   
                    <div class="absolute inset-0 rounded-full border border-purple-700/30 animate-spin" style="animation-duration:20s"></div>
                    <div class="absolute inset-4 rounded-full border border-purple-600/20 animate-spin" style="animation-duration:15s;animation-direction:reverse"></div>
                    <div class="absolute inset-8 rounded-full border border-purple-500/30 animate-pulse"></div>

               
                    <div class="absolute inset-0 flex items-center justify-center">
                        <div class="w-40 h-40 rounded-full bg-gradient-to-br from-purple-900 to-purple-700 flex items-center justify-center"
                             style="box-shadow:0 0 60px rgba(168,85,247,0.5),0 0 120px rgba(168,85,247,0.2)">
                            <i class="fas fa-shield-halved text-6xl text-gradient"
                               style="filter:drop-shadow(0 0 20px rgba(168,85,247,0.8))"></i>
                        </div>
                    </div>

                    
                    <?php
                    for ($dotIndex = 0; $dotIndex < 6; $dotIndex++) {
                       
                        $angleDegrees = $dotIndex * 60;

                        
                        $angleRadians = deg2rad($angleDegrees);
                        $xOffset      = round(140 * sin($angleRadians), 1);
                        $yOffset      = round(140 * cos($angleRadians), 1);

                        
                        $animationDelay = $dotIndex * 0.3;
                    ?>
                    <div class="absolute w-3 h-3 rounded-full bg-purple-400 animate-pulse"
                         style="top:calc(50% - 6px + <?php echo $yOffset; ?>px);
                                left:calc(50% - 6px + <?php echo $xOffset; ?>px);
                                box-shadow:0 0 8px rgba(168,85,247,0.8);
                                animation-delay:<?php echo $animationDelay; ?>s"></div>
                    <?php }  ?>
                </div>
            </div>

        </div>

        
        <div class="grid grid-cols-3 gap-4 mt-16">
            <?php
            
            if ($isMM) {
                $statItems = array(
                    array('val' => $statsLaws,   'label' => 'ဆိုက်ဘာဥပဒေများ'),
                    array('val' => $statsCrimes, 'label' => 'ကျူးလွန်မှု အမျိုးအစားများ'),
                    array('val' => $statsMedia,  'label' => 'မီဒီယာဖိုင်များ'),
                );
            } else {
                $statItems = array(
                    array('val' => $statsLaws,   'label' => 'Cyber Laws'),
                    array('val' => $statsCrimes, 'label' => 'Crime Types'),
                    array('val' => $statsMedia,  'label' => 'Media Files'),
                );
            }

            
            foreach ($statItems as $stat) {
            ?>
            <div class="text-center p-6 bg-[rgba(20,0,50,0.6)] border border-purple-900/30 rounded-xl">
               
                <div class="font-orbitron font-extrabold text-4xl stat-number-gradient text-white">
                    <?php echo $stat['val']; ?>
                </div>
                
                <?php
                if ($isMM) {
                    $statLabelClass = 'text-purple-400/70 text-sm mt-1 font-myanmar';
                } else {
                    $statLabelClass = 'text-purple-400/70 text-sm mt-1';
                }
                ?>
                <div class="<?php echo $statLabelClass; ?>">
                    <?php echo $stat['label']; ?>
                </div>
            </div>
            <?php }  ?>
        </div>

    </div>
</section>

<?php 

include 'footer.php';

?>