<?php
// mentorship.php
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Advanced Mentorship – SkillSphere</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <script src="https://cdn.tailwindcss.com"></script>
  <style>
    body {
      /* Replace the URL below with your preferred background image */
      background: url('//https://i.pinimg.com/1200x/f6/74/e9/f674e9bbd677d3a8ee9f4905b5549ac8.jpg') no-repeat center center fixed;
      background-size: cover;
      min-height: 100vh;
    }
    .shine {
      background: linear-gradient(90deg, #6366f1 0%, #22d3ee 100%);
      -webkit-background-clip: text;
      -webkit-text-fill-color: transparent;
    }
    .badge {
      font-weight: 600;
      border-radius: .6em;
      padding: .22em .8em;
      margin-right: .35em;
      font-size: .87em;
      display:inline-block;
    }
    .available { background: #22c55e; color: #181e2a; font-weight: 700; padding: .18em .7em; border-radius: .5em; font-size: .87em;}
    .busy { background: #ef4444; color: #fff; font-weight: 700; padding: .18em .7em; border-radius: .5em; font-size: .87em;}
    .faculty-badge { background: #f59e42; color: #181e2a; font-weight: 600; border-radius: .7em; padding: .18em .8em; margin-right: .35em;}
    .mentor-card {
      border-radius: 1.2em;
      box-shadow: 0 8px 32px #0004;
      padding: 2em 1.2em 1.5em 1.2em;
      margin-bottom: 2em;
      position: relative;
      background: rgba(29, 34, 49, 0.93);
      transition:.3s;
      border-top: 8px solid #6366f1;
      overflow: hidden;
      min-height: 390px;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
    }
    .mentor-card:hover { box-shadow: 0 16px 50px #22d3ee55; transform: translateY(-4px) scale(1.03);}
    .mentor-banner {
      background: linear-gradient(90deg,#6366f1 60%,#22d3ee 100%);
      height: 75px;
      border-top-left-radius:1.2em;
      border-top-right-radius:1.2em;
      position: absolute; top:0; left:0; width:100%; z-index:0;
      opacity: .14;
      pointer-events: none;
    }
    .mentor-card-content {
      position: relative;
      z-index: 1;
    }
    .mentor-avatar {
      width: 84px; height: 84px; border-radius: 50%;
      border: 4px solid #fff; object-fit:cover;
      box-shadow: 0 4px 22px #6366f155;
      margin: -46px auto 0 auto; display: block;
      background: #222b3a;
    }
    .mentor-status-dot {
      width: 1em; height: 1em; border-radius: 50%; display:inline-block; vertical-align: middle; margin-right:.4em;
      box-shadow: 0 2px 6px #2223;
    }
    .mentor-actions button {
      margin-right: 0.5em;
      margin-bottom: 0.5em;
    }
    .session-btn {
      background:#6366f1; color:#fff; font-weight:600;
      border-radius:1em; padding:.6em 1.4em; border:none; cursor:pointer;
      box-shadow:0 4px 20px #6366f166; transition:.2s;
      margin-bottom:.2em;
    }
    .session-btn:hover { background:#22d3ee; color:#181e2a;}
    .modal-bg { display:none; position:fixed; inset:0; background:rgba(34,34,49,0.89); z-index:1101; justify-content:center; align-items:center;}
    .modal-content { background:#181e2a; color:#e2e8f0; border-radius:1.1em; padding:2em; max-width:550px; width:90%; position:relative; box-shadow:0 14px 46px #22d3ee44; animation:scaleUp .3s ease;}
    @keyframes scaleUp { from { transform:scale(.8); opacity:0;} to {transform:scale(1); opacity:1;} }
    .close-modal { position:absolute; top:1.1em; right:1.3em; font-size:1.5em; color:#22d3ee; background:none; border:none; cursor:pointer;}
    @media (max-width:900px) {
      .mentor-card { padding: 1em; min-height:340px;}
      .modal-content { padding: 1em; }
      .mentor-banner { height:44px; }
      .mentor-actions button { margin-bottom:.5em;}
    }
    /* Help button */
    .help-btn {
      position: fixed;
      right: 32px;
      bottom: 32px;
      z-index: 2000;
      background: linear-gradient(90deg,#6366f1 60%,#22d3ee 100%);
      color: #fff;
      font-weight: 700;
      border-radius: 2em;
      padding: 0.7em 2em;
      font-size: 1.08em;
      box-shadow: 0 6px 20px #6366f166;
      border: none;
      cursor: pointer;
      transition: background .2s;
    }
    .help-btn:hover { background: #22d3ee; color: #222831;}
    .help-info-box {
      display:none;
      position: fixed;
      right: 32px;
      bottom: 88px;
      z-index: 2001;
      background: #181e2a;
      color: #e2e8f0;
      border-radius: 1.2em;
      padding: 2em 2em 2em 2em;
      max-width: 420px;
      box-shadow: 0 12px 40px #22d3ee55;
      text-align: left;
      font-size: 1.02em;
    }
    .help-info-box h2 {color: #22d3ee;font-size: 1.35rem;font-weight: bold;margin-bottom: 0.7em;}
    .help-info-close { position: absolute; top: 1.1rem; right: 1.3rem; font-size: 1.6rem; color: #22d3ee; background: none; border: none; cursor: pointer; font-weight: bold;}
    @media (max-width:900px){
      .help-btn, .help-info-box { position:static; right:auto; bottom:auto; margin-bottom:1em;}
    }
  </style>
</head>
<body class="font-sans">

<div class="max-w-7xl mx-auto px-4 py-8">
  <h1 class="text-4xl shine font-bold mb-6">Mentor Directory</h1>
  <div class="flex flex-col md:flex-row gap-4 mb-8">
    <select id="collegeFilter" class="p-3 rounded-lg bg-gray-800 text-white">
      <option value="all">All (Global & Internal)</option>
      <option value="internal">Internal (SNA/Your College)</option>
      <option value="global">Global (Outside College)</option>
    </select>
    <select id="typeFilter" class="p-3 rounded-lg bg-gray-800 text-white">
      <option value="all">All Mentors</option>
      <option value="faculty">Faculty</option>
      <option value="alumni">Alumni</option>
    </select>
    <select id="skillsFilter" class="p-3 rounded-lg bg-gray-800 text-white">
      <option value="all">All Skills</option>
      <option value="AI/ML">AI/ML</option>
      <option value="Web Dev">Web Dev</option>
      <option value="Cybersecurity">Cybersecurity</option>
      <option value="Cloud">Cloud</option>
      <option value="DevOps">DevOps</option>
      <option value="UI/UX">UI/UX</option>
      <option value="Networking">Networking</option>
      <option value="Teaching">Teaching</option>
      <option value="Coding">Coding</option>
      <option value="Leadership">Leadership</option>
      <option value="CTF">CTF</option>
      <option value="Python">Python</option>
      <option value="React">React</option>
      <option value="Automation">Automation</option>
      <option value="Data Science">Data Science</option>
    </select>
  </div>
  <h2 class="text-2xl shine font-bold mb-3">Faculty Mentors</h2>
  <div id="facultyGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7 mb-10"></div>
  <h2 class="text-2xl shine font-bold mb-3">Alumni Mentors</h2>
  <div id="alumniGrid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-7"></div>
</div>

<!-- Help Button -->
<button class="help-btn" onclick="document.getElementById('helpInfoBox').style.display='block'">Help</button>
<div class="help-info-box" id="helpInfoBox">
  <button class="help-info-close" onclick="document.getElementById('helpInfoBox').style.display='none'">&times;</button>
  <h2>Mentor Directory – How This Works</h2>
  <p>
    This page connects students to Faculty and Alumni mentors.<br>
    <ul>
      <li><b>Filters:</b> Find mentors by type (faculty/alumni), skills, and internal/global.</li>
      <li><b>Mentor Cards:</b> Each card shows expertise, status, points, and actions. Colors match their main skill domain!</li>
      <li><b>Profile:</b> Click <b>View Profile</b> for full info, feedback, experience, and to rate the mentor.</li>
      <li><b>Messaging:</b> Use <b>Message</b> to chat privately with any mentor.</li>
      <li><b>Mentorship Requests:</b> Submit and track requests; see the count in profiles.</li>
      <li><b>Ratings & Feedback:</b> Rate mentors and leave feedback for others to see.</li>
      <li>All profiles are demo/fake for showcase! You can customize, add images, and integrate real backend.</li>
    </ul>
  </p>
</div>

<!-- Mentor Profile Modal -->
<div class="modal-bg" id="profileModal">
  <div class="modal-content" id="profileContent"></div>
</div>
<!-- Request Mentorship Modal -->
<div class="modal-bg" id="requestModal">
  <div class="modal-content" id="requestContent"></div>
</div>
<!-- Messaging Modal -->
<div class="modal-bg" id="msgModal">
  <div class="modal-content" id="msgContent"></div>
</div>

<script>
// Accent colors for skills/domains
const domainColors = {
  "AI/ML":"#6366f1",
  "Web Dev":"#0ea5e9",
  "Cybersecurity":"#ef4444",
  "Cloud":"#22c55e",
  "DevOps":"#f59e42",
  "UI/UX":"#a855f7",
  "Networking":"#06b6d4",
  "Teaching":"#f59e42",
  "Coding":"#6366f1",
  "Leadership":"#f59e42",
  "CTF":"#db2777",
  "Python":"#eab308",
  "React":"#0ea5e9",
  "Automation":"#22d3ee",
  "Data Science":"#6366f1"
};
const avatars = [
  "https://img.icons8.com/color/96/user-tie.png",
  "https://img.icons8.com/color/96/user-female-circle--v2.png",
  "https://img.icons8.com/color/96/user-male-circle--v2.png"
];

// Demo feedback store
const feedbacks = {
  alumni1: [
    {user:"Sandy",stars:5,comment:"Amazing cloud mentor!"},
    {user:"Alice",stars:4,comment:"Very helpful for AWS doubts."},
  ],
  faculty1: [
    {user:"Guruprasanth",stars:5,comment:"Inspiring teaching style."},
    {user:"Karthick",stars:5,comment:"Great at explaining AI concepts."}
  ]
};
// Demo mentorship requests store
let mentorshipRequests = [];

// Generate 20+ fake mentors (faculty, alumni)
const names = [
  "Dr. Naveenkumar","Abishek","Karthick","Rahul","Dinesh","Guru","Suriya",
  "Sandy","Makesh","Catherine","Bob","Alice","Sathish","Meena","Jayanth",
  "Harini","Priya S. Anand","Vinoth","Ramesh","Ananya","Kavya","Manoj","Vikram"
];
function genMentor(type, i) {
  // Random skill, status, company, main color
  const skillsArr = Object.keys(domainColors);
  const skill1 = skillsArr[Math.floor(Math.random()*skillsArr.length)];
  const skill2 = skillsArr[Math.floor(Math.random()*skillsArr.length)];
  const companies = ["Google","Meta","Amazon","TCS","Zoho","PayPal","Flipkart","Cognizant","Freshworks","Cisco","Microsoft","OpenAI"];
  const company = companies[Math.floor(Math.random()*companies.length)];
  const statuses = ["Available","Busy"];
  const status = statuses[Math.floor(Math.random()*statuses.length)];
  const img = avatars[i%avatars.length];
  const name = names[i%names.length] + (i>names.length?` ${i}`:"");
  const isFaculty = type==="faculty";
  const isAlumni = type==="alumni";
  return {
    id: type+i,
    name: name,
    role: isFaculty ? ("Professor, "+skill1) : skill1+" Specialist",
    company: isFaculty ? "SNA College" : company,
    location: isFaculty ? "SNA Campus" : "Remote",
    img: img,
    status: status,
    statusClass: status==="Available"?"available":"busy",
    badges: [
      skill1,
      skill2,
      ...(isFaculty?["Teaching","🎓 Faculty Mentor"]:[(i%3===0?"Mentor Badge":"")].filter(Boolean))
    ],
    about: (isFaculty?"Expert in "+skill1+", "+skill2+" teaching.":"Works at "+company+", "+skill1+" and "+skill2+" mentor."),
    skills: [skill1,skill2,isFaculty?"Teaching":"Coding"],
    office: isFaculty ? "Mon-Fri "+(10+i%6)+"am-"+(12+i%6)+"pm" : "",
    canTeach: isFaculty, canCode: true, canNetwork: skill1==="Networking"||skill2==="Networking",
    mentorships: ["Alice","Bob","Priya","Guru","Rahul"].filter((_,idx)=>idx<i%5),
    rating: (4.5+((i%5)*0.1)).toFixed(1),
    points: isFaculty ? undefined : 700+Math.floor(Math.random()*500),
    points_hidden: isFaculty ? false : (i%4===0),
    experience: isAlumni ? [{company:company,title:skill1+" Specialist",years:"2022–present"}] : undefined,
    education: isAlumni ? [{degree:"B.Tech "+skill1,inst:"SNA College",years:"2016–2020"}] : undefined,
    scope: (i%3===0?"global":"internal"),
    type: type
  };
}

// Generate mentors
const facultyMentors = Array.from({length:10}, (_,i)=>genMentor("faculty",i));
const alumniMentors = Array.from({length:15}, (_,i)=>genMentor("alumni",i));

// Utilities
function badgeColor(badge) { return domainColors[badge] || "#6366f1"; }
function statusDotColor(status) { return status === "Available" ? "#22c55e" : "#ef4444"; }

// Render Functions
function renderMentorCards(list, gridId, type) {
  const grid=document.getElementById(gridId);
  grid.innerHTML="";
  list.forEach((m,idx)=>{
    let borderColor = badgeColor(m.skills[0]);
    let bgGrad = `linear-gradient(120deg, ${borderColor} 0%, #232946 100%)`;
    grid.innerHTML+=`
    <div class="mentor-card" style="border-top:8px solid ${borderColor};background:rgba(29,34,49,0.96);background-image:${bgGrad};">
      <div class="mentor-banner"></div>
      <div class="mentor-card-content">
        <img src="${m.img}" class="mentor-avatar">
        <div class="flex items-center justify-between mt-2 mb-1">
          <div class="text-xl font-bold ${type==='faculty'?'text-yellow-400':''}">${m.name}</div>
          ${type==='faculty'?'<span class="faculty-badge">🎓 Faculty</span>':''}
        </div>
        <div class="text-gray-400 mb-2">${m.role}${type==='alumni'?' @ '+m.company:''}</div>
        <div class="mb-2 flex flex-wrap items-center gap-2">
          <span class="mentor-status-dot" style="background:${statusDotColor(m.status)}"></span>
          <span class="${m.statusClass}">${m.status}</span>
          ${m.badges.map(b=>`<span class="badge" style="background:${badgeColor(b)}">${b}</span>`).join("")}
        </div>
        ${m.office?`<div class="text-gray-300 mb-2 text-sm">Office Hours: ${m.office}</div>`:""}
        <div class="text-gray-300 mb-2 text-sm">Mentorships: ${m.mentorships.join(", ")}</div>
        <div class="mentor-actions flex flex-wrap gap-2">
          <button class="session-btn" onclick="openMentorModal('${type}', '${m.id}')">View Profile</button>
          <button class="session-btn" onclick="openRequestModal('${m.name}')">Request</button>
          <button class="session-btn" onclick="openMsgModal('${m.name}')">Message</button>
        </div>
      </div>
    </div>`;
  });
}
function filterMentors() {
  const college = document.getElementById("collegeFilter").value;
  const type = document.getElementById("typeFilter").value;
  const skill = document.getElementById("skillsFilter").value;
  let facultyFiltered = facultyMentors.filter(m =>
    (college === "all" || m.scope === college) &&
    (type === "all" || type === "faculty") &&
    (skill === "all" || m.skills.includes(skill))
  );
  let alumniFiltered = alumniMentors.filter(m =>
    (college === "all" || m.scope === college) &&
    (type === "all" || type === "alumni") &&
    (skill === "all" || m.skills.includes(skill))
  );
  renderMentorCards(facultyFiltered, "facultyGrid", "faculty");
  renderMentorCards(alumniFiltered, "alumniGrid", "alumni");
}
filterMentors();
document.getElementById("collegeFilter").addEventListener("change", filterMentors);
document.getElementById("typeFilter").addEventListener("change", filterMentors);
document.getElementById("skillsFilter").addEventListener("change", filterMentors);

// Profile Modal
function openMentorModal(type, id){
  let m = type === 'faculty'
    ? facultyMentors.find(x=>x.id===id)
    : alumniMentors.find(x=>x.id===id);
  if(!m) return;
  let exp = m.experience ? m.experience.map(e=>`<li>🏢 ${e.company} — <span class="text-blue-300">${e.title}</span> (${e.years})</li>`).join("") : "";
  let edu = m.education ? m.education.map(e=>`<li>🎓 ${e.degree} <span class="text-blue-300">@${e.inst}</span> (${e.years})</li>`).join("") : "";
  let points = typeof m.points !== "undefined" ? `<span class="badge">Points: ${m.points_hidden?"Hidden":m.points}</span>` : "";
  let skills = m.skills.map(s=>`<span class="badge" style="background:${badgeColor(s)}">${s}</span>`).join("");
  let mentorships = m.mentorships ? `<div class="mb-2 text-sm">Mentorships: <span class="badge">${m.mentorships.join(", ")}</span></div>` : "";
  let office = m.office ? `<div class="mb-2 text-sm"><b>Office Hours:</b> ${m.office}</div>` : "";
  let capabilities = type === "faculty"
    ? `<div class="mb-2 text-sm"><b>Capabilities:</b> 
         <span class="badge" style="background:${badgeColor('Teaching')}">${m.canTeach?"Teaching":""}</span>
         <span class="badge" style="background:${badgeColor('Coding')}">${m.canCode?"Coding":""}</span>
         <span class="badge" style="background:${badgeColor('Networking')}">${m.canNetwork?"Networking":""}</span>
       </div>` : "";
  let rating = m.rating ? `<span class="badge">⭐ ${m.rating}</span>` : "";
  let company = m.company ? `<div class="mb-2 text-sm">Current Company: <span class="badge">${m.company}</span></div>` : "";
  document.getElementById("profileContent").innerHTML=`
    <button class="close-modal" onclick="closeProfileModal()">&times;</button>
    <div class="mentor-banner"></div>
    <div class="mentor-card-content">
      <img src="${m.img}" class="mentor-avatar">
      <h2 class="text-2xl font-bold mb-2">${m.name}</h2>
      <div class="text-gray-400 mb-2">${m.role}${type==="alumni"?" @ "+m.company:""} ${m.badges.map(b=>`<span class="badge" style="background:${badgeColor(b)}">${b}</span>`).join("")}</div>
      <div class="mb-2"><span class="${m.statusClass}">${m.status} Now</span> ${rating} ${points}</div>
      <div class="text-gray-400 mb-2">${m.location}</div>
      <div class="mb-2"><b>About:</b> ${m.about}</div>
      ${company}
      ${capabilities}
      ${office}
      ${mentorships}
      ${exp?`<b>Work Experience:</b><ul class="ml-3 mb-3">${exp}</ul>`:""}
      ${edu?`<b>Education:</b><ul class="ml-3 mb-3">${edu}</ul>`:""}
      <b>Skills:</b> ${skills}
      <div class="flex flex-wrap gap-2 mt-3">
        <button class="session-btn" onclick="openRequestModal('${m.name}')">Request Mentorship</button>
        <button class="session-btn" onclick="openMsgModal('${m.name}')">Message</button>
        <span style="margin-left:1em;">Rate: <span class="badge">${[1,2,3,4,5].map(i=>`<span class="star" onclick="rateMentor('${m.id}',${i})" style="cursor:pointer;color:#facc15;">★</span>`).join("")}</span></span>
      </div>
    </div>
  `;
  document.getElementById("profileModal").style.display="flex";
}
function closeProfileModal(){document.getElementById("profileModal").style.display="none";}

// Request Modal
function openRequestModal(name){
  closeProfileModal();
  document.getElementById("requestContent").innerHTML=`
    <button class="close-modal" onclick="closeRequestModal()">&times;</button>
    <h2 class="text-xl mb-3">Request Mentorship</h2>
    <div class="mb-2">Mentor: <b>${name}</b></div>
    <form onsubmit="event.preventDefault(); trackMentorship('${name}');">
      <label class="block mb-2 text-sm">Purpose:</label>
      <textarea required class="w-full mb-4 p-2 rounded bg-gray-800 text-white" id="reqPurpose" rows="3" placeholder="E.g. Career guidance, Project help..."></textarea>
      <button type="submit" class="session-btn w-full">Send Request</button>
    </form>`;
  document.getElementById("requestModal").style.display="flex";
}
function closeRequestModal(){document.getElementById("requestModal").style.display="none";}

// Mentorship request tracking
function trackMentorship(name){
  mentorshipRequests.push({mentor:name, purpose:document.getElementById("reqPurpose").value});
  alert("Mentorship request sent and tracked!");
  closeRequestModal();
}

// Messaging Modal
function openMsgModal(name){
  closeProfileModal();
  document.getElementById("msgContent").innerHTML=`
    <button class="close-modal" onclick="closeMsgModal()">&times;</button>
    <h2 class="text-xl mb-3">Send Message to ${name}</h2>
    <form onsubmit="event.preventDefault(); sendMessage('${name}');">
      <textarea required class="w-full mb-4 p-2 rounded bg-gray-800 text-white" id="msgText" rows="3" placeholder="Type your private message..."></textarea>
      <button type="submit" class="session-btn w-full">Send Message</button>
    </form>
    <div id="msgHistory"></div>
  `;
  document.getElementById("msgModal").style.display="flex";
}
function closeMsgModal(){document.getElementById("msgModal").style.display="none";}

// Message system (demo, no backend)
const msgStore = {};
function sendMessage(name){
  let val = document.getElementById("msgText").value.trim();
  if(!val) return;
  if(!msgStore[name]) msgStore[name]=[];
  msgStore[name].push({from:"You", text:val, time:new Date().toLocaleTimeString([],{hour:'2-digit',minute:'2-digit'})});
  renderMsgHistory(name);
  document.getElementById("msgText").value="";
}
function renderMsgHistory(name){
  let area = document.getElementById("msgHistory");
  if(!msgStore[name] || !msgStore[name].length){area.innerHTML="";return;}
  area.innerHTML = "<b>Message history:</b><br>"+msgStore[name].map(m=>`<div class="badge" style="background:#6366f1;color:#fff;margin-bottom:.2em;"><b>${m.from}</b>: ${m.text} <span style="font-size:.8em;color:#e2e8f0;">${m.time}</span></div>`).join("");
}

// Rating system (feedback)
function rateMentor(id, stars){
  let who = "You";
  let comment = prompt("Leave feedback for this mentor:");
  if(!comment) return;
  if(!feedbacks[id]) feedbacks[id]=[];
  feedbacks[id].push({user:who,stars:stars,comment:comment});
  alert("Thanks for your rating!");
  closeProfileModal();
}

// Close modals by clicking outside
window.onclick=function(e){
  if(e.target===document.getElementById("profileModal")) closeProfileModal();
  if(e.target===document.getElementById("requestModal")) closeRequestModal();
  if(e.target===document.getElementById("msgModal")) closeMsgModal();
};
</script>

</body>
</html>