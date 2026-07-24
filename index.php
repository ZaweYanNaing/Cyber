<?php
require_once 'database.php';

// ── Language ─────────────────────────────────────────────────
$lang = (isset($_GET['lang']) && $_GET['lang'] === 'mm') ? 'mm' : 'en';
$isMM = ($lang === 'mm');

// ── Queries ──────────────────────────────────────────────────
$laws        = $conn->query("SELECT * FROM cyber_laws WHERE is_active = 1")->fetch_all(MYSQLI_ASSOC);
$statsLaws   = $conn->query("SELECT COUNT(*) as t FROM cyber_laws")->fetch_assoc()['t'];
$statsCrimes = $conn->query("SELECT COUNT(*) as t FROM crimes")->fetch_assoc()['t'];
$statsMedia  = $conn->query("SELECT COUNT(*) as t FROM media")->fetch_assoc()['t'];
$categories  = $conn->query("SELECT DISTINCT category FROM cyber_laws WHERE is_active = 1 ORDER BY category")->fetch_all(MYSQLI_ASSOC);

$catIcons = [
    'Cybercrime'        => 'fa-bug',
    'Digital Commerce'  => 'fa-shopping-cart',
    'Telecommunications'=> 'fa-satellite-dish',
    'Privacy'           => 'fa-user-shield',
    'General'           => 'fa-scale-balanced',
];
?>
<!DOCTYPE html>
<html lang="<?= $isMM ? 'my' : 'en' ?>">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title><?= $isMM ? 'ဆိုက်ဘာဥပဒေ သတိပြုမှုစနစ်' : 'Cyber Law Awareness System' ?></title>
<meta name="description" content="Explore Myanmar Cyber Laws in English and Burmese">

<!-- Tailwind CSS v4 (CDN) -->
<script src="https://cdn.jsdelivr.net/npm/@tailwindcss/browser@4"></script>

<!-- Google Fonts -->
<link rel="preconnect" href="https://fonts.googleapis.com">
<link href="https://fonts.googleapis.com/css2?family=Orbitron:wght@700;900&family=Inter:wght@400;500;600;700&family=Noto+Sans+Myanmar:wght@400;600&display=swap" rel="stylesheet">

<!-- Font Awesome -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

<style type="text/tailwindcss">
    @theme {
        --font-orbitron: 'Orbitron', sans-serif;
        --font-myanmar:  'Noto Sans Myanmar', sans-serif;
        --font-sans:     'Inter', sans-serif;
    }
</style>
</head>
<body class="bg-black text-purple-100 font-['Inter'] overflow-x-hidden">

<!-- ══ NAV ══════════════════════════════════════════════════ -->
<nav class="sticky top-0 z-50 bg-black/85 border-b border-purple-900/30 backdrop-blur-xl">
    <div class="max-w-7xl mx-auto px-6 py-3 flex items-center justify-between gap-4">

        <!-- Logo -->
        <a href="index.php" class="flex items-center gap-3 no-underline">
            <div class="w-10 h-10 rounded-xl bg-gradient-to-br from-purple-600 to-purple-400 flex items-center justify-center text-white shadow-[0_0_12px_rgba(168,85,247,0.5)]">
                <i class="fas fa-shield-halved"></i>
            </div>
            <div>
                <div class="font-['Orbitron'] font-black text-xs text-white tracking-wider">CYBER LAW</div>
                <div class="text-[10px] text-purple-500"><?= $isMM ? 'သတိပြုမှုစနစ်' : 'Awareness System' ?></div>
            </div>
        </a>

        <!-- Links -->
        <div class="hidden md:flex items-center gap-8">
            <a href="index.php<?= $isMM ? '?lang=mm' : '' ?>" class="text-purple-400 hover:text-purple-300 text-sm font-medium tracking-wide no-underline transition-colors">
                <?= $isMM ? 'ပင်မစာမျက်နှာ' : 'Home' ?>
            </a>
            <a href="#laws" class="text-purple-400 hover:text-purple-300 text-sm font-medium tracking-wide no-underline transition-colors">
                <?= $isMM ? 'ဥပဒေများ' : 'Laws' ?>
            </a>
            <a href="search.php<?= $isMM ? '?lang=mm' : '' ?>" class="text-purple-400 hover:text-purple-300 text-sm font-medium tracking-wide no-underline transition-colors">
                <?= $isMM ? 'ရှာဖွေမှု' : 'Search' ?>
            </a>
        </div>

        <!-- Lang Toggle -->
        <div class="flex bg-[rgba(20,0,50,0.8)] border border-purple-900/30 rounded-lg overflow-hidden">
            <a href="?lang=en" class="px-4 py-1.5 text-xs font-semibold no-underline transition-all <?= !$isMM ? 'bg-purple-700 text-white' : 'text-purple-400' ?>">EN</a>
            <a href="?lang=mm" class="px-4 py-1.5 text-xs font-semibold no-underline transition-all <?= $isMM  ? 'bg-purple-700 text-white' : 'text-purple-400' ?>">မြန်မာ</a>
        </div>
    </div>
</nav>

<!-- ══ HERO ══════════════════════════════════════════════════ -->
<section class="relative overflow-hidden min-h-[88vh] flex items-center bg-black">

    <!-- Grid bg -->
    <div class="absolute inset-0 pointer-events-none"
         style="background-image:linear-gradient(rgba(124,58,237,.06) 1px,transparent 1px),linear-gradient(90deg,rgba(124,58,237,.06) 1px,transparent 1px);background-size:60px 60px"></div>

    <!-- Glow blobs -->
    <div class="absolute rounded-full pointer-events-none blur-[80px]"
         style="width:400px;height:400px;background:radial-gradient(circle,rgba(124,58,237,.28),transparent);top:-120px;right:-80px"></div>
    <div class="absolute rounded-full pointer-events-none blur-[80px]"
         style="width:300px;height:300px;background:radial-gradient(circle,rgba(34,211,238,.12),transparent);bottom:-60px;left:-60px"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-20 w-full grid grid-cols-1 lg:grid-cols-2 gap-12 items-center">

        <!-- Text Column -->
        <div>
            <!-- Badge -->
            <div class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full bg-purple-600/20 border border-purple-600/40 text-purple-300 text-xs font-bold tracking-widest mb-6">
                <i class="fas fa-shield-halved text-xs"></i>
                <?= $isMM ? 'ဆိုက်ဘာဘေးကင်းရေး' : 'Digital Law Awareness' ?>
            </div>

            <!-- Title -->
            <h1 class="font-['Orbitron'] font-black leading-tight mb-5" style="font-size:clamp(2rem,5vw,3.2rem)">
                <?php if ($isMM): ?>
                    <span class="text-white">ဆိုက်ဘာ</span> <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">ဥပဒေ</span><br>
                    <span class="text-white">သတိပြုမှု</span> <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">စနစ်</span>
                <?php else: ?>
                    <span class="text-white">Cyber</span> <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">Law</span><br>
                    <span class="text-white">Awareness</span> <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">System</span>
                <?php endif; ?>
            </h1>

            <!-- Description -->
            <p class="text-purple-300/65 text-lg leading-relaxed mb-8 max-w-lg <?= $isMM ? "font-['Noto_Sans_Myanmar']" : '' ?>">
                <?= $isMM
                    ? 'မြန်မာနိုင်ငံ ဆိုက်ဘာဥပဒေများကို ရှာဖွေကြည့်ရှုပြီး ဒစ်ဂျစ်တယ် ကျူးလွန်မှုများနှင့် ပြစ်ဒဏ်များကို နားလည်ပါ။'
                    : 'Explore Myanmar Cyber Laws, understand digital crimes and their penalties. Available in English and Burmese.' ?>
            </p>

            <!-- Buttons -->
            <div class="flex flex-wrap gap-3 mb-10">
                <a href="#laws"
                   class="inline-flex items-center gap-2 bg-gradient-to-br from-purple-700 to-purple-500 text-white font-bold text-sm tracking-wide px-7 py-3 rounded-xl no-underline shadow-[0_0_20px_rgba(168,85,247,0.4)] hover:shadow-[0_0_35px_rgba(168,85,247,0.6)] hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-scale-balanced"></i>
                    <?= $isMM ? 'ဥပဒေများ ကြည့်ရှုရန်' : 'Browse Laws' ?>
                </a>
                <a href="search.php<?= $isMM ? '?lang=mm' : '' ?>"
                   class="inline-flex items-center gap-2 bg-transparent border border-purple-900/40 text-purple-300 font-semibold text-sm px-7 py-3 rounded-xl no-underline hover:bg-purple-600/15 hover:border-purple-600 hover:-translate-y-0.5 transition-all duration-300">
                    <i class="fas fa-search"></i>
                    <?= $isMM ? 'အဆင့်မြင့် ရှာဖွေမှု' : 'Advanced Search' ?>
                </a>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-3 gap-3">
                <?php
                $stats = $isMM
                    ? [[$statsLaws,'ဆိုက်ဘာဥပဒေများ'],[$statsCrimes,'ကျူးလွန်မှု အမျိုးအစားများ'],[$statsMedia,'မီဒီယာဖိုင်များ']]
                    : [[$statsLaws,'Cyber Laws'],[$statsCrimes,'Crime Types'],[$statsMedia,'Media Files']];
                foreach ($stats as [$val, $label]): ?>
                <div class="text-center p-5 bg-[rgba(20,0,50,0.6)] border border-purple-900/30 rounded-2xl hover:border-purple-700/60 hover:-translate-y-1 transition-all duration-300">
                    <div class="font-['Orbitron'] font-black text-3xl bg-gradient-to-r from-purple-500 to-purple-300 bg-clip-text text-transparent">
                        <?= $val ?>
                    </div>
                    <div class="text-purple-400/70 text-xs mt-1 <?= $isMM ? "font-['Noto_Sans_Myanmar']" : '' ?>"><?= $label ?></div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Visual Column -->
        <div class="hidden lg:flex justify-center items-center">
            <div class="relative w-80 h-80">
                <!-- Rings -->
                <div class="absolute inset-0 rounded-full border border-purple-700/30 animate-spin" style="animation-duration:20s"></div>
                <div class="absolute inset-4 rounded-full border border-purple-600/20 animate-spin" style="animation-duration:15s;animation-direction:reverse"></div>
                <div class="absolute inset-8 rounded-full border border-purple-500/30 animate-pulse"></div>
                <!-- Core -->
                <div class="absolute inset-0 flex items-center justify-center">
                    <div class="w-40 h-40 rounded-full bg-gradient-to-br from-purple-900 to-purple-700 flex items-center justify-center shadow-[0_0_60px_rgba(168,85,247,0.5),0_0_120px_rgba(168,85,247,0.2)]">
                        <i class="fas fa-shield-halved text-6xl text-white/85" style="filter:drop-shadow(0 0 16px rgba(168,85,247,0.9))"></i>
                    </div>
                </div>
                <!-- Orbit dots -->
                <?php for ($i = 0; $i < 6; $i++):
                    $x = round(140 * sin(deg2rad($i * 60)), 1);
                    $y = round(140 * cos(deg2rad($i * 60)), 1);
                ?>
                <div class="absolute w-2.5 h-2.5 rounded-full bg-purple-400 animate-pulse shadow-[0_0_8px_rgba(168,85,247,0.8)]"
                     style="top:calc(50% - 5px + <?= $y ?>px);left:calc(50% - 5px + <?= $x ?>px);animation-delay:<?= $i * 0.3 ?>s"></div>
                <?php endfor; ?>
            </div>
        </div>

    </div>
</section>

<!-- ══ LAW CARDS ═════════════════════════════════════════════ -->
<section id="laws" class="py-20 bg-black">
    <div class="max-w-7xl mx-auto px-6">

        <!-- Section Header -->
        <div class="text-center mb-12">
            <p class="text-purple-600 text-xs font-bold tracking-[.15em] uppercase mb-3">
                <?= $isMM ? 'ဥပဒေများ' : 'LEGAL FRAMEWORK' ?>
            </p>
            <h2 class="font-['Orbitron'] font-black text-white mb-3" style="font-size:clamp(1.6rem,3vw,2.2rem)">
                <?php if ($isMM): ?>
                    ဆိုက်ဘာဥပဒေများ <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">ကြည့်ရှုပါ</span>
                <?php else: ?>
                    Explore <span class="bg-gradient-to-r from-purple-600 to-purple-400 bg-clip-text text-transparent">Cyber Laws</span>
                <?php endif; ?>
            </h2>
            <div class="w-14 h-0.5 bg-gradient-to-r from-purple-700 to-purple-400 rounded-full shadow-[0_0_8px_rgba(168,85,247,0.5)] mx-auto mb-3"></div>
            <p class="text-purple-400/65 max-w-xl mx-auto <?= $isMM ? "font-['Noto_Sans_Myanmar']" : '' ?>">
                <?= $isMM
                    ? 'မြန်မာနိုင်ငံတွင် သက်ရောက်မှုရှိသော ဆိုက်ဘာဥပဒေများကို ကြည့်ရှုပါ။'
                    : 'Browse all active cyber and digital laws in Myanmar with descriptions and associated crimes.' ?>
            </p>
        </div>

        <!-- Category Filter -->
        <?php if (!empty($categories)): ?>
        <div class="flex flex-wrap gap-2 justify-center mb-10" id="cat-filter">
            <button class="cat-btn inline-flex items-center gap-1 px-4 py-1.5 rounded-full text-xs font-bold tracking-wide cursor-pointer border border-purple-500/60 bg-purple-600/30 text-purple-200 active"
                    data-cat="all">
                <?= $isMM ? 'အားလုံး' : 'All' ?>
            </button>
            <?php foreach ($categories as $cat):
                $icon = $catIcons[$cat['category']] ?? 'fa-scale-balanced'; ?>
            <button class="cat-btn inline-flex items-center gap-1.5 px-4 py-1.5 rounded-full text-xs font-semibold tracking-wide cursor-pointer border border-purple-600/40 bg-purple-600/15 text-purple-300 hover:bg-purple-600/30 hover:border-purple-500/60 hover:text-white transition-all"
                    data-cat="<?= e($cat['category']) ?>">
                <i class="fas <?= $icon ?> text-xs"></i>
                <?= e($cat['category']) ?>
            </button>
            <?php endforeach; ?>
        </div>
        <?php endif; ?>

        <!-- Cards Grid -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6" id="laws-grid">
            <?php if (!empty($laws)): ?>
                <?php foreach ($laws as $i => $law):
                    // Crime count for this law
                    $stmt = $conn->prepare("SELECT COUNT(*) as t FROM crimes WHERE law_id = ?");
                    $stmt->bind_param("i", $law['id']);
                    $stmt->execute();
                    $crimeCount = $stmt->get_result()->fetch_assoc()['t'];

                    $title = $isMM ? $law['title_mm']       : $law['title_en'];
                    $desc  = $isMM ? $law['description_mm'] : $law['description_en'];
                    $icon  = $catIcons[$law['category']] ?? 'fa-scale-balanced';
                    $emoji = !empty($law['icon']) ? $law['icon'] : '⚖️';
                    $link  = 'law-detail.php?id=' . $law['id'] . ($isMM ? '&lang=mm' : '');
                    $delay = ($i % 6) * 80;
                ?>
                <a href="<?= $link ?>"
                   class="law-card block no-underline bg-[rgba(20,0,50,0.7)] border border-purple-900/30 rounded-2xl p-6 backdrop-blur-xl hover:border-purple-700 hover:-translate-y-1.5 hover:shadow-[0_0_30px_rgba(168,85,247,0.2)] transition-all duration-300 opacity-0 translate-y-5"
                   data-cat="<?= e($law['category']) ?>"
                   style="transition-delay:<?= $delay ?>ms">

                    <!-- Top row -->
                    <div class="flex items-start justify-between mb-4">
                        <!-- Emoji Icon -->
                        <div class="w-12 h-12 rounded-xl bg-gradient-to-br from-purple-900 to-purple-700 flex items-center justify-center text-2xl flex-shrink-0 shadow-[0_0_12px_rgba(168,85,247,0.4)]">
                            <?= e($emoji) ?>
                        </div>
                        <!-- Badge + Year -->
                        <div class="flex flex-col items-end gap-1.5">
                            <span class="inline-flex items-center gap-1 px-3 py-1 rounded-full bg-purple-600/20 border border-purple-600/40 text-purple-300 text-[11px] font-semibold">
                                <i class="fas <?= $icon ?> text-[10px]"></i>
                                <?= e($law['category']) ?>
                            </span>
                            <?php if (!empty($law['year'])): ?>
                            <span class="text-purple-500/60 text-[11px] font-['Orbitron']"><?= e($law['year']) ?></span>
                            <?php endif; ?>
                        </div>
                    </div>

                    <!-- Title -->
                    <h3 class="font-['Orbitron'] font-bold text-white text-sm leading-snug mb-2 line-clamp-2">
                        <?= e($title) ?>
                    </h3>

                    <!-- Description -->
                    <p class="text-purple-300/60 text-sm leading-relaxed mb-4 line-clamp-3 <?= $isMM ? "font-['Noto_Sans_Myanmar']" : '' ?>">
                        <?= e(mb_substr($desc, 0, 130)) ?>…
                    </p>

                    <!-- Footer row -->
                    <div class="flex items-center justify-between pt-3 border-t border-purple-900/40">
                        <span class="text-purple-400/65 text-xs">
                            <i class="fas fa-gavel mr-1"></i>
                            <?= $crimeCount ?> <?= $isMM ? 'ကျူးလွန်မှုများ' : 'Crimes' ?>
                        </span>
                        <span class="text-purple-400 text-xs font-semibold flex items-center gap-1">
                            <?= $isMM ? 'ကြည့်ရှုရန်' : 'View Details' ?>
                            <i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </a>
                <?php endforeach; ?>
            <?php else: ?>
                <div class="col-span-3 text-center py-20">
                    <i class="fas fa-database text-6xl text-purple-800 mb-4 block"></i>
                    <p class="text-purple-400"><?= $isMM ? 'ဥပဒေ မရှိသေးပါ။' : 'No laws found. Add laws via the Admin panel.' ?></p>
                </div>
            <?php endif; ?>
        </div>

    </div>
</section>
<?php include 'footer.php' ?>

<script>
// ── Fade-in cards on scroll ──────────────────────────────────
const observer = new IntersectionObserver(entries => {
    entries.forEach(entry => {
        if (entry.isIntersecting) {
            entry.target.style.opacity  = '1';
            entry.target.style.transform = 'translateY(0)';
            observer.unobserve(entry.target);
        }
    });
}, { threshold: 0.08 });

document.querySelectorAll('.law-card').forEach(card => {
    card.style.transition = 'opacity .5s ease, transform .5s ease, border-color .3s, box-shadow .3s, translate .3s';
    observer.observe(card);
});

// ── Category filter ──────────────────────────────────────────
document.querySelectorAll('.cat-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Toggle active style
        document.querySelectorAll('.cat-btn').forEach(b => {
            b.classList.remove('bg-purple-600/30','border-purple-500/60','text-purple-200');
            b.classList.add('bg-purple-600/15','border-purple-600/40','text-purple-300');
        });
        btn.classList.remove('bg-purple-600/15','border-purple-600/40','text-purple-300');
        btn.classList.add('bg-purple-600/30','border-purple-500/60','text-purple-200');

        const cat = btn.dataset.cat;
        document.querySelectorAll('.law-card').forEach(card => {
            card.style.display = (cat === 'all' || card.dataset.cat === cat) ? 'block' : 'none';
        });
    });
});
</script>
</body>
</html>