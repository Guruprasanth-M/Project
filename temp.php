<?php
// temp.php
$users = [
    1 => [
        "name" => "Alice Smith",
        "batch" => "2022",
        "college" => "SNA",
        "avatar" => "https://img.icons8.com/color/96/user-female-circle--v2.png",
        "about" => "Passionate about AI and data science.",
        "skills" => ["Python", "Machine Learning", "Data Science"],
        "experience" => "Worked on ML projects during internships.",
        "projects" => ["ML Model for Prediction", "AI Chatbot"]
    ],
    2 => [
        "name" => "Bob Johnson",
        "batch" => "2023",
        "college" => "TechU",
        "avatar" => "https://img.icons8.com/color/96/user-male-circle--v2.png",
        "about" => "Full-stack web developer with MERN expertise.",
        "skills" => ["React", "NodeJS", "MongoDB", "Express"],
        "experience" => "Internship at WebSoft as React Developer.",
        "projects" => ["Portfolio Website", "E-Commerce App"]
    ],
    3 => [
        "name" => "Catherine Lee",
        "batch" => "2022",
        "college" => "CodeUni",
        "avatar" => "https://img.icons8.com/color/96/user-female-circle--v2.png",
        "about" => "Creative designer passionate about user experience.",
        "skills" => ["UI/UX", "Figma", "Prototyping"],
        "experience" => "Designed apps and dashboards for startups.",
        "projects" => ["Travel App Design", "Food Delivery UI"]
    ]
];

$id = isset($_GET['id']) ? intval($_GET['id']) : 0;
$user = $users[$id] ?? null;
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo $user ? $user['name'] : "Profile"; ?> – Profile</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-black text-white font-sans">

<div class="max-w-4xl mx-auto py-12 px-6">
    <?php if ($user): ?>
        <div class="bg-gray-900 rounded-xl p-8 shadow-lg text-center mb-8">
            <img src="<?php echo $user['avatar']; ?>" class="w-28 h-28 rounded-full mx-auto mb-4">
            <h1 class="text-3xl font-bold mb-2"><?php echo $user['name']; ?></h1>
            <p class="text-gray-400"><?php echo $user['college']; ?> • Batch <?php echo $user['batch']; ?></p>
        </div>

        <!-- About -->
        <div class="bg-gray-900 rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-2">About</h2>
            <p class="text-gray-300"><?php echo $user['about']; ?></p>
        </div>

        <!-- Skills -->
        <div class="bg-gray-900 rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-2">Skills</h2>
            <div class="flex flex-wrap gap-2">
                <?php foreach ($user['skills'] as $skill): ?>
                    <span class="bg-blue-700 px-3 py-1 rounded text-sm"><?php echo $skill; ?></span>
                <?php endforeach; ?>
            </div>
        </div>

        <!-- Experience -->
        <div class="bg-gray-900 rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-2">Experience</h2>
            <p class="text-gray-300"><?php echo $user['experience']; ?></p>
        </div>

        <!-- Projects -->
        <div class="bg-gray-900 rounded-xl p-6 mb-6">
            <h2 class="text-2xl font-semibold mb-2">Projects</h2>
            <ul class="list-disc list-inside text-gray-300">
                <?php foreach ($user['projects'] as $project): ?>
                    <li><?php echo $project; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php else: ?>
        <p class="text-center text-gray-400">User not found.</p>
    <?php endif; ?>
</div>

</body>
</html>
